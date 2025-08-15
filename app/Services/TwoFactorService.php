<?php

namespace App\Services;

class TwoFactorService
{
    public function generateSecret(int $length = 16): string
    {
        return $this->base32Encode(random_bytes($length));
    }

    public function getQRCodeUrl(string $company, string $email, string $secret): string
    {
        $otpauth = sprintf('otpauth://totp/%s:%s?secret=%s&issuer=%s', rawurlencode($company), rawurlencode($email), $secret, rawurlencode($company));
        return 'https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' . urlencode($otpauth);
    }

    public function verify(string $secret, string $code, int $window = 1): bool
    {
        $timeSlice = (int) floor(time() / 30);
        for ($i = -$window; $i <= $window; $i++) {
            if (hash_equals($this->calculateCode($secret, $timeSlice + $i), $code)) {
                return true;
            }
        }

        return false;
    }

    protected function calculateCode(string $secret, int $timeSlice): string
    {
        $secretKey = $this->base32Decode($secret);
        $time = pack('N*', 0) . pack('N*', $timeSlice);
        $hash = hash_hmac('sha1', $time, $secretKey, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncatedHash = substr($hash, $offset, 4);
        $value = unpack('N', $truncatedHash)[1] & 0x7FFFFFFF;
        $mod = $value % 1000000;
        return str_pad((string) $mod, 6, '0', STR_PAD_LEFT);
    }

    protected function base32Encode(string $data): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $binary = '';
        foreach (str_split($data) as $char) {
            $binary .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
        }
        $output = '';
        foreach (str_split($binary, 5) as $segment) {
            if (strlen($segment) < 5) {
                $segment = str_pad($segment, 5, '0');
            }
            $output .= $alphabet[bindec($segment)];
        }
        return $output;
    }

    protected function base32Decode(string $secret): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = strtoupper($secret);
        $bits = '';
        foreach (str_split($secret) as $char) {
            $pos = strpos($alphabet, $char);
            if ($pos !== false) {
                $bits .= str_pad(decbin($pos), 5, '0', STR_PAD_LEFT);
            }
        }
        $binary = '';
        foreach (str_split($bits, 8) as $byte) {
            if (strlen($byte) === 8) {
                $binary .= chr(bindec($byte));
            }
        }
        return $binary;
    }
}
