# Whim Menu Buttons Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace Whim’s single menu button with three PDF menu buttons while preserving the reservation button.

**Architecture:** Copy the supplied PDFs into the existing public Dining asset path and link them directly from the Dining Blade view. Reuse the current button classes and flex-wrap layout.

**Tech Stack:** Laravel 8, Blade, HTML

## Global Constraints

- Menu PDFs open in a new tab.
- Button styling must reuse the existing website style.
- “Reserve Your Table” remains unchanged.
- Do not add a Dining navigation submenu.

---

### Task 1: Add Whim menu PDF links

**Files:**
- Create: `public/img/dining/whim-breakfast-menu.pdf`
- Create: `public/img/dining/whim-lunch-dinner-menu.pdf`
- Create: `public/img/dining/whim-beverage-menu.pdf`
- Modify: `resources/views/pages/main/dining/index.blade.php:223-228`

**Interfaces:**
- Consumes: The three supplied Whim PDF files and the existing `btn-book-header` class.
- Produces: Three public PDF links in the Whim Dining section.

- [ ] **Step 1: Run a failing assertion**

```bash
php -d zend.assertions=1 -d assert.exception=1 -r '$view=file_get_contents("resources/views/pages/main/dining/index.blade.php"); foreach (["Breakfast Menu","Lunch &amp; Dinner Menu","Beverage Menu"] as $label) assert(str_contains($view,$label)); foreach (["whim-breakfast-menu.pdf","whim-lunch-dinner-menu.pdf","whim-beverage-menu.pdf"] as $file) assert(file_exists("public/img/dining/".$file));'
```

Expected: FAIL because the new labels and PDF assets do not exist.

- [ ] **Step 2: Copy the supplied PDFs**

Copy the three source PDFs to the exact public paths listed above, using
lowercase filenames without spaces.

- [ ] **Step 3: Replace the menu link**

Replace “Our Menu” with three `<a>` elements using `asset('img/dining/...')`,
`target="_blank"`, `rel="noopener"`, and
`class="btn btn-book-header ms-0"`. Do not change the reservation link.

- [ ] **Step 4: Run the assertion**

Run the Step 1 command again.

Expected: exit code 0.

- [ ] **Step 5: Review the diff**

```bash
git diff --check
git diff -- resources/views/pages/main/dining/index.blade.php
```

Expected: no whitespace errors; only the intended menu links changed.
