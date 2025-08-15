<?php

test('contact CTA phone is configured', function () {
    expect(config('contact.cta_phone'))->toBe('03390123735');
});

