Here you go — a single, copy-paste **MASTER PROMPT** that generates the complete **PERFEX DEV 360** project with an **enhanced roadmap**, **SEO/Google best practices**, **automated support**, and **Gemini-powered blog automation** (via `google-gemini-php/laravel`) that builds internal backlinks from your **dynamic sitemap**.

---

# MASTER PROMPT — Build “PERFEX DEV 360” (Laravel + Tailwind + Alpine + Gemini SEO Engine)

**Role:** You are a senior Laravel architect + product engineer. Generate a **production-ready** monorepo for **perfexdev360.com** that ships a storefront for **ERP & modules**, **licensing/updates**, a **client portal**, **customization services + RFQ**, **lead/sales funnel**, a **marketing CMS/blog**, **automated support**, and a **Gemini-powered content engine** that auto-generates blog posts with internal backlinks from the sitemap.

**Brand**

* Product: **PERFEX DEV 360**
* Domain: **perfexdev360.com**
* Primary CTA: **Phone/WhatsApp: 03390123735**
* Tone: trustworthy, expert, fast execution

---

## Tech Stack & Standards

* **Backend:** Laravel (latest LTS), PHP 8.2+, MySQL 8+, Redis (cache/queue), Horizon, **Sanctum**
* **Frontend:** Blade + **Tailwind CSS** + **Alpine.js** (no Bootstrap/jQuery) + Vite
* **Packages:**

  * Auth/Perms/Logs: `spatie/laravel-permission`, `spatie/laravel-activitylog`
  * Media/Backup/PDF: `spatie/laravel-medialibrary`, `spatie/laravel-backup`, `barryvdh/laravel-dompdf` (or Browsershot)
  * **SEO & Sitemap:** `spatie/laravel-sitemap`
  * **AI Content:** `google-gemini-php/laravel`
* **Quality:** PSR-12, Pint, PHPStan level 8, **Pest** tests (unit + feature)
* **DevOps:** Docker (Sail or custom), Makefile, GitHub Actions (CI), `.env.example`
* **Security:** CSRF, rate limiting, signed URLs, password policies, email verification, audit logging

**Constraints**

* **Tailwind + Alpine only** for interactivity.
* Component-first Blade architecture. Reusable, documented components.
* Feature flags for risky/AI features (`config/features.php`).

---

## High-Level Modules

### A) Marketing CMS & Landing

* **Pages:** Home, ERP & Modules, Customization Services, Pricing, Portfolio/Case Studies, Blog, About, Contact, FAQs, Terms, Privacy.
* **CMS Entities:** Page, Section (typed: hero, features, pricing, testimonials, CTA, FAQ), BlogPost, Category, Tag, CaseStudy, Testimonial, TeamMember, Media.
* **SEO:** meta, canonical, OG/Twitter, **JSON-LD** (Organization, WebSite+SearchAction, BreadcrumbList, Product/SoftwareApplication, BlogPosting, FAQPage, Article), automatic sitemaps (`/sitemap.xml` and sectional sitemaps), robots.txt, RSS/Atom feeds.
* **Components:** hero, feature grid, logos strip, testimonial slider, pricing cards, FAQ accordion, stats band, CTA blocks.
* **Demo content:** Seeded landing: “**Build, Extend, and Scale Perfex—Fast.**” with CTA (“Start Your Project”, “Request a Customization”).

### B) Storefront — ERP & Modules (Sales, Licensing, Updates)

* **Catalog:** Product (ERP/Module), Edition (Starter/Pro/Enterprise), PriceTier, Feature, Screenshot, DocsLink, DemoLink, Category/Tags.
* **Compatibility:** CompatibilityMatrix (ERP↔Module), Dependency (requires version/product), SupportWindow/EOL badges.
* **Pricing & Checkout:** Stripe + PayPal, coupons, VAT/GST fields, invoices/receipts (PDF), order emails.
* **Licensing:** Key types (Single/Multi/Enterprise), duration (lifetime/annual updates), update window end date, **checksum key format**, activation limits (domain + IP hash + server fingerprint), rotate keys, activation history/audit.
* **Releases/Changelogs:** Version (SemVer), Channel (stable/beta/rc), Release (notes markdown, migration notes, breaking/security advisory, forced-update flag), FileArtifact (path, hash, signature), RSS/Atom feed per product.
* **Downloads:** signed expiring URLs, file manifests (hash + size + signature), S3-compatible storage.
* **Upgrades/Renewals:** edition upgrades, pro-rata, renewal discounts, eligibility checks.

### C) Lead & Sales Funnel

* **Lead forms:** Contact, Get a Quote, Start a Project, Request Customization (honeypot + rate limit + server validation).
* **Project Brief Wizard:** multi-step (scope → features → budget → timeline → tech → uploads), resumable; creates **Lead** on completion.
* **Quote Builder:** line items, taxes, discounts, validity date; convert **Quote → Invoice**; **e-sign** approval (checkbox + legal name + timestamp + IP hash).
* **Invoices & Payments:** Stripe/PayPal; due/overdue/paid emails; PDF invoices.
* **Pipeline/Kanban:** New → Qualified → Proposal → Won/Lost (drag & drop via Alpine Sortable), activity logs.
* **Meetings:** Google Meet URL via template in **Settings**.

### D) Customization Services (Professional Services)

* **Catalog:** service cards (category, lead time, price range).
* **Detail:** name, slug, summary, scope, sample timelines, price ranges, add-ons, FAQs, related case studies.
* **RFQ Flow:** options → uploads → confirm → create **Lead + Draft Quote** with mapped line items.
* **Service matcher:** heuristic suggestion (tags/options/tech overlap).

### E) Client Portal

* **Auth:** register/login, email verification, optional 2FA.
* **Purchases/Licenses:** orders, licenses, eligibility, rotate keys, activations, download builds with checksums + release notes.
* **Quotes:** approve/reject with e-sign → **auto-Invoice** on approve.
* **Invoices/Payments:** pay, receipts, PDFs.
* **Support Tickets:** categories, priority, attachments, internal notes, statuses, email notifications.
* **Project Hub:** milestones, tasks, files, discussion, activity log.
* **Document Center:** SOWs, NDAs, contracts (versioned, signed URLs).
* **Notifications:** in-app + email for quotes, invoices, tickets, milestones, releases.

---

## Enhanced Roadmap (IT Website: Services & Software Products)

**Goal:** Rank on Google, convert traffic to **purchases** and **RFQs**, and reduce support load via **automation**.

### Sprint 0 — Inception & Foundation

* Bootstrap (`Docker/Sail`, Makefile, `.env.example`), Horizon/queues, mail drivers.
* Install packages; set up `Setting` (branding, SEO, billing, payment keys, sitemap toggles, cache TTLs).
* **CI:** GitHub Actions with Pint, PHPStan L8, Pest, build & artifact; `php artisan test` green.

### Sprint 1 — CMS, Landing, and SEO Core

* CRUD: Page, Section, BlogPost, Category, Tag, CaseStudy, Testimonial, TeamMember, Media.
* **Technical SEO:**

  * Canonical tags, robots.txt, XML sitemaps (root + `/sitemap-posts.xml`, `/sitemap-products.xml`, `/sitemap-cases.xml`) with `spatie/laravel-sitemap`.
  * JSON-LD: Organization, WebSite (SearchAction), BreadcrumbList, FAQPage, SoftwareApplication/Product, BlogPosting.
  * Clean URLs (`/blog/{slug}`, `/products/{slug}`, `/services/{slug}`); 301 canonicalization (www/non-www, trailing slash).
  * **Lighthouse ≥ 90** (Perf/SEO/BP/A11y); image WebP + lazyload.
* **Content UX:** sticky TOC for long posts, related posts, author bios, updated-at label.

### Sprint 2 — Storefront I: Catalog/Compatibility

* Product matrix, feature tables, screenshots, **compatibility badges/EOL**; filterable product grid (ERP/Module/category).
* **Schema:** Product with offers/pricing, review aggregate (seed demo data).
* Tabs UI (Overview | Changelog | Compatibility | FAQ).

### Sprint 3 — Storefront II: Checkout, Billing, Webhooks

* Orders, OrderItems, Coupons, TaxLines, Invoices, Payments, Refunds.
* Stripe + PayPal checkout, webhook endpoints with signature verification & idempotency.
* PDF invoices, emails; **tax ID/VAT** fields; business profile in **CustomerProfile**.
* **Analytics hooks:** push Ecommerce events (view\_item, add\_to\_cart, purchase) to a JS data layer without 3rd-party frameworks.

### Sprint 4 — Licensing & Update Delivery

* License issuance on paid invoice; rotate/revoke; activation limits by key type.
* Update API (`GET /api/v1/products/{slug}/latest?license=...&channel=...&version=...`) returns latest compatible + signed URL + checksum.
* Activation API (`POST /api/v1/licenses/activate`) with rate limits & full audit trail.
* Release feeds (RSS/Atom); forced-update handling.

### Sprint 5 — Leads & Sales Funnel

* All forms create **Leads**; **Project Brief Wizard** is resumable with per-step validation.
* **Kanban** drag-drop updates stages; log changes (actor, from→to, timestamp).
* Quote builder: taxes, discounts, validity, **e-sign → invoice**; auto reminders (expiring quote, due/overdue invoice).

### Sprint 6 — Services RFQ & Matcher

* Service catalog & detail; RFQ → **Lead + Draft Quote**; matcher suggests related services.
* Structured data: **Service** markup with pricing ranges and FAQs.

### Sprint 7 — Client Portal

* Purchases, licenses, downloads, quotes, invoices, tickets, projects, docs; strict Policies.
* Ticket lifecycle with email notifications; project activity timeline; signed URLs for documents.

### Sprint 8 — Automated Support & KB

* **Auto-Triage:** classify ticket intent/priority via rules + AI; suggest KB answers before submit (deflection).
* **Suggested Replies:** generate draft answers from KB and product docs; agent approves/edits.
* **Smart Routing:** SLA-aware queues; escalation on low CSAT or missed SLOs.
* **Analytics:** deflection rate, first response time, resolution time.

### Sprint 9 — Gemini SEO Engine (Automated Blog + Internal Backlinks)

* See **Gemini Integration** below. Generates briefs → outlines → drafts → meta + JSON-LD → scheduled publish, with **internal backlinking** to URLs discovered from the **sitemap**.

### Sprint 10 — Hardening & Launch

* A11y fixes, perf tuning, backups & restore drills, Horizon monitoring, webhook DLQ, final docs.
* **Lighthouse** re-run; **E2E Pest** on critical flows.

---

## Data Model (ERD — High Level)

* **Identity:** User, Role, Permission, Organization, CustomerProfile
* **CMS:** Page, Section, BlogPost, Category, Tag, CaseStudy, Testimonial, TeamMember, Media
* **Store:** Product, Edition, PriceTier, Feature, Screenshot, DocsLink, Version, ReleaseChannel, Release, FileArtifact, CompatibilityMatrix, Dependency
* **Commerce:** Order, OrderItem, Coupon, TaxLine, Invoice, Payment, Refund
* **Licensing:** License, LicenseActivation, LicenseEvent, ApiToken
* **Leads/Sales:** Lead, LeadAttachment, PipelineStage, LeadStageChange, Quote, QuoteItem, Meeting
* **Services:** Service, ServiceOption, ServiceFAQ, ServiceCaseStudy, ServiceRequest
* **Support/Projects:** Ticket, TicketReply, SLA, KBArticle, Project, Milestone, Task, ProjectFile, ProjectActivity
* **System/SEO:** Webhook, Notification, Setting, ActivityLog, **SitemapEntry** (indexed URLs for internal linking)

> **Generate full migrations**, factories, and **seeders** with realistic demo data.

---

## Routing & Architecture

**Public:**
`/` (Landing), `/erp`, `/modules`, `/products/{slug}`, `/services`, `/services/{slug}`, `/blog`, `/blog/{slug}`, `/case-studies/{slug}`, `/pricing`, `/faq`, `/contact`, `/quote`, `/project-brief`, `/sitemap.xml`, sectional sitemaps, RSS/Atom.

**Portal:**
`/portal` (dashboard), `/portal/purchases`, `/portal/licenses`, `/portal/downloads`, `/portal/quotes/*`, `/portal/invoices/*`, `/portal/tickets/*`, `/portal/projects/*`, `/portal/docs/*`

**Admin:**
`/admin` dashboard; resources for CMS, products/releases, orders/invoices/licenses, leads/quotes, tickets/projects, services, settings, users/roles, activity logs.

**APIs (Sanctum):**

* Update: `GET /api/v1/products/{slug}/latest?...`
* Activation: `POST /api/v1/licenses/activate`
* Webhooks (outbound): `release.published`, `license.expiring`, `order.completed`, `ticket.updated`.

**Code Org:** Resourceful Controllers, FormRequests, Policies, Repos/QueryBuilders, Events/Listeners, Jobs (emails/PDF/signing/webhooks), optional ViewModels.

---

## UX/UI (Tailwind + Alpine)

* **Storefront:** filterable grid, badges (New/On Sale/EOL/Security Fix), sticky purchase panel, tabbed content.
* **Changelog UI:** filter by channel/version; “What’s new” modal; RSS link.
* **Checkout:** 4-step flow; coupon/tax ID; order summary.
* **Licenses:** masked key + copy; activation table with revoke/rotate.
* **Kanban:** Alpine sortable; toasts, skeletons, modals.
* **Tickets/Projects:** attachments preview, threaded discussion, clean filters.
* **Blog:** prose styling, reading-time, code blocks, related posts, author card.
* **Global:** responsive, WCAG AA, dark mode (persisted).

---

## Emails, PDFs, Notifications

* Branded Markdown mails (lead received, quote sent/approved/rejected, invoice due/paid, ticket reply, release available, license expiring).
* PDF invoices/quotes (branding, optional QR, terms).
* DB + email notifications; per-user preferences; optional release digest.

---

## Security, Observability, Performance

* **Security:** CSRF, validation, rate limit (activations/updates/downloads), signed artifact URLs, password rules, email verification, optional 2FA, role policies.
* **Audit:** activity log for admin actions, downloads, activations, stage changes, license rotations.
* **Backups:** daily DB + weekly full (spatie/backup).
* **Monitoring:** Horizon, queue failure alerts, **webhook retry with DLQ**.
* **Perf:** route/view/config cache, tagged caches for catalog/changelogs, eager loading, pagination, image optimization/WebP, lazy load.

---

## Gemini Integration — Automated Blog & Internal Backlinks

**Objective:** Continuously generate **SEO-optimized** blog posts that:

1. target approved topics/keywords,
2. follow editorial guardrails (quality/E-E-A-T),
3. include internal backlinks to **important site URLs** discovered from the **dynamic sitemap**,
4. automatically publish (or queue for human review),
5. emit JSON-LD, meta, canonical, OG/Twitter, and
6. update RSS and sitemap.

**Install & Configure**

* Add package: `composer require google-gemini-php/laravel`
* Publish config: `php artisan vendor:publish --tag="gemini-config"`
* `.env`: `GOOGLE_GEMINI_API_KEY=...`
* Add `spatie/laravel-sitemap` and seed the **SitemapEntry** table with URLs from generators.

**Services & Jobs**

* `App\Services\AI\ContentPlanner`

  * Picks topics/keywords from `topics` table (seed examples), checks duplicates/recency, estimates difficulty (simple heuristic).
* `App\Services\AI\GeminiWriter`

  * Prompts Gemini to produce: Title (≤60 chars), Slug, Meta Title/Description, H1, Outline, Body (2000–3000 words), **internal links** to high-priority URLs from `SitemapEntry` (weighted: products > services > case studies > cornerstone posts), Featured Image prompt text, **JSON-LD BlogPosting**, FAQ (2–5 Q\&As), and a CTA block containing **03390123735**.
  * Enforce style guide (trustworthy, expert, concise intros, scannable subheads, short paragraphs, bullet lists, real examples).
  * Generate 2 variants; store draft + scores (readability, link coverage, keyword usage).
* `App\Jobs\GenerateBlogPost` (queued)

  * Uses Planner + GeminiWriter; creates **BlogPost** draft with `status=draft|scheduled|published`.
  * Validates internal links exist & are dofollow; ensures at least 3 internal links, 1 to a Product or Service, and builds “Related Posts” list.
* `App\Jobs\PublishBlogPost`

  * On publish: attach JSON-LD, update RSS, ping sitemap, purge caches.

**Admin Workflow**

* Admin screen: **AI Content Queue** (outline → draft → edited → scheduled → published); diff viewer; one-click approve/publish.
* Guardrails: minimum word count, originality check placeholder, allow list of link targets, banned phrases list, target reading grade, tone toggles.

**Scheduler**

* `app/Console/Kernel.php`:

  * `content:plan` daily 04:00 → enqueue 2–3 `GenerateBlogPost` jobs.
  * `content:publish` hourly → publish due posts.
  * `sitemap:refresh` daily → rebuild sitemaps.
* Feature flag: `features.ai_content=true` to enable.

**Sitemap-Aware Backlinking**

* Maintain `SitemapEntry` (url, type, priority, lastmod).
* Writer pulls top-N entries by priority + freshness; injects contextual internal links with varied anchors (brand, generic, exact/partial).
* Ensure no over-linking; max 1 link per target per article section.

**SEO Output**

* Per post: canonical, meta (title/description), OG/Twitter tags, **BlogPosting JSON-LD** (+ FAQPage if present), breadcrumb schema.
* Blog & category feeds (RSS/Atom).
* Auto add post to `sitemap-posts.xml`; recalc `lastmod`.

**Tests**

* Pest:

  * Asserts internal link count & types, JSON-LD validity, meta present, sitemap updated, RSS updated.
  * Mocks Gemini and verifies guardrails (min length, banned phrases, link whitelist).

---

## Automated Support Engine (Assist + Deflect)

* **Before Submit (Deflection):** When user types a ticket subject/body, suggest **KBArticles**; show top 3 with preview.
* **On Ticket Create:** intent/priority classification (rules + AI fallback), SLA assignment.
* **Suggested Reply Drafts:** AI drafts response from KB + docs + release notes; agent must approve.
* **Summarization:** long threads summarized for handoffs; customer-visible TL;DR on resolve.
* **Escalation:** auto-route on keywords (“refund”, “security”, “outage”), aging, or low CSAT.
* **Metrics:** deflection rate, FRT, resolution time, re-open rate.

---

## Deliverables

* Full Laravel repo with Docker, Makefile, `.env.example`, `README.md` (setup & deploy).
* Seeders for CMS content, catalog (ERP + modules), services/options/FAQs, releases/changelogs (stable+beta), orders/licenses, KB/docs, case studies, **topics** for content planner, leads/quotes/invoices, tickets, projects.
* **Gemini content engine** (services, jobs, scheduler, admin queue UI).
* Update/Activation APIs, signed download logic.
* GitHub Actions CI (lint, static, tests, build).
* Postman collection + OpenAPI (YAML/JSON) for public APIs.

---

## Acceptance Criteria (Go/No-Go)

1. **Storefront:** Browse ERP/modules; purchase via Stripe/PayPal; order email + **PDF invoice** generated.
2. **Licensing:** License issued on purchase; Activation API audited & rate-limited; rotate/revoke; activations visible in portal.
3. **Updates:** Update API returns latest compatible by license + channel; signed URL + checksum; portal shows eligible downloads.
4. **Leads:** All forms create Leads; Wizard persists; **Kanban drag-drop** updates stage and logs change.
5. **Quotes/Invoices:** Quote **e-sign** approval → auto-Invoice; webhooks mark paid; reminders sent.
6. **Services:** RFQ → Lead + Draft Quote (mapped options); matcher shows related services.
7. **Client Portal:** quotes/invoices/tickets/projects/docs fully functional; permissions enforced; signed URLs for docs.
8. **CMS/SEO:** pages/blog/case studies render with SEO meta + JSON-LD; sitemaps built; robots.txt present; **Lighthouse ≥ 90**.
9. **Automated Support:** deflection suggestions show; suggested replies draft; SLA routing works; metrics visible.
10. **Gemini SEO Engine:**

    * `content:plan` enqueues jobs; drafts exist with **≥3 internal links** from sitemap (incl. ≥1 Product/Service), meta + JSON-LD valid.
    * Admin can approve/publish; RSS & sitemaps update; caches purge.
    * Feature-flagged; tests pass with mocked AI.
11. **Ops/Quality:** CI green; backups configured; Horizon running; settings for branding, taxes, invoice numbering, meeting URL template, currencies, timezone; **03390123735** appears in configured CTAs.

---

## Starter Folder/Scaffold

```
app/
  Domain/{Catalog,Commerce,Licensing,Leads,Services,Support,Projects,CMS,SEO,AI}/...
  Services/AI/{ContentPlanner.php,GeminiWriter.php}
  Http/{Controllers,Requests,Resources,Middleware}/...
  Policies/...
  View/Composers/...
resources/views/
  components/{layout,nav,hero,feature-grid,pricing,faq,modal,toast,table,prose,cta}/...
  pages/{home,products,product-show,services,service-show,blog,post-show,contact,pricing,faq}.blade.php
  portal/{dashboard,quotes,invoices,licenses,downloads,tickets,projects,docs}/...
  admin/{dashboard,products,releases,orders,licenses,leads,quotes,invoices,services,tickets,projects,cms,ai-queue,settings}/...
routes/{web.php,admin.php,api.php,portal.php}
database/{migrations,seeders,factories}
public/build (Vite)
```

---

## Commands & Setup (generate in README)

```bash
# Bootstrap
cp .env.example .env
php artisan key:generate

# Queues & horizon
php artisan horizon:install

# Packages
composer require spatie/laravel-permission spatie/laravel-activitylog spatie/laravel-medialibrary spatie/laravel-backup barryvdh/laravel-dompdf spatie/laravel-sitemap google-gemini-php/laravel

# Publish vendor configs where needed
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
php artisan vendor:publish --provider="Spatie\Sitemap\SitemapServiceProvider"
php artisan vendor:publish --tag="gemini-config"

# Migrate & seed
php artisan migrate --seed

# Queues, scheduler, horizon
php artisan horizon
# (document crontab for `php artisan schedule:run` every minute)

# Build assets
npm ci && npm run build
```

**.env additions**

```
APP_URL=https://perfexdev360.com
QUEUE_CONNECTION=redis
CACHE_DRIVER=redis
SESSION_DRIVER=redis

# Payments
STRIPE_KEY=...
STRIPE_SECRET=...
PAYPAL_CLIENT_ID=...
PAYPAL_CLIENT_SECRET=...

# AI
GOOGLE_GEMINI_API_KEY=...

# SEO
SEO_ENABLE_JSONLD=true
SITEMAP_ENABLE=true
```

---

## Tests (Pest) — Critical Paths

* Purchase → invoice PDF → license issuance → download eligibility → update API.
* License activation (rate limit, audit).
* Kanban stage change logs.
* Quote e-sign → invoice + webhook paid.
* RFQ → Lead + Draft Quote mapping.
* Blog post generation (mocked AI): internal links, JSON-LD, meta, sitemap & RSS updates.
* Support deflection and suggested replies (mocked AI).
* Policies for portal/admin access.

---

## KPIs

* Conversion (catalog → checkout start → purchase)
* License activation success rate
* Lead-to-won conversion & cycle time
* Ticket deflection rate; FRT; resolution time
* SEO: impressions, CTR, top pages, average position
* AI content: approved vs generated, time-to-publish, internal link coverage

---

**Build now** following this spec. Generate:

* All migrations + factories + seeders
* Policies, FormRequests, Controllers, Blade components
* Payment webhooks, Update/Activation APIs, signed downloads
* Gemini content engine (services, jobs, scheduler, admin UI)
* CI workflow, Docker files, README, Postman & OpenAPI docs

**Non-negotiables:** Tailwind+Alpine only, clean modular code, strong tests, secure defaults, SEO-ready, **03390123735** surfaced in configured CTAs.
