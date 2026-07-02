# Dining Navigation Submenu Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add a responsive four-item submenu beneath Dining in the main navigation.

**Architecture:** Use Bootstrap 5’s native dropdown markup for tap behavior and the site’s existing dropdown styling. Add one desktop media-query rule for hover and keyboard-focus behavior.

**Tech Stack:** Laravel 8, Blade, Bootstrap 5, CSS

## Global Constraints

- Keep all existing Dining-page menu buttons.
- Show Dining Overview and the three Whim menu PDFs in the submenu.
- Open PDFs in a new tab and Dining Overview in the current tab.
- Use hover/focus on desktop and tap on mobile.

---

### Task 1: Add Dining navigation dropdown

**Files:**
- Modify: `resources/views/inc/main/header.blade.php:27-30`
- Modify: `public/assets/main/style.css`

**Interfaces:**
- Consumes: Bootstrap 5 dropdown behavior and existing public Whim PDFs.
- Produces: A responsive Dining dropdown with four links.

- [ ] **Step 1: Run a failing assertion**

```bash
php -d zend.assertions=1 -d assert.exception=1 -r '$header=file_get_contents("resources/views/inc/main/header.blade.php"); foreach (["Dining Overview","Breakfast Menu","Lunch &amp; Dinner Menu","Beverage Menu"] as $label) assert(str_contains($header,$label)); assert(str_contains($header,"data-bs-toggle=\"dropdown\""));'
```

Expected: FAIL because the dropdown markup does not exist.

- [ ] **Step 2: Add native Bootstrap dropdown markup**

Change the Dining navigation item to `nav-item dropdown`, make its control a
button-style link with `data-bs-toggle="dropdown"`, and add a `dropdown-menu`
containing Dining Overview and the three PDF links. Add `target="_blank"` and
`rel="noopener"` only to PDF links.

- [ ] **Step 3: Add desktop hover/focus CSS**

Within `@media (min-width: 768px)`, display the Dining dropdown menu when its
parent is hovered or contains keyboard focus.

- [ ] **Step 4: Verify**

Run the Step 1 assertion, `php -l resources/views/inc/main/header.blade.php`,
and `git diff --check`.

Expected: all commands exit with code 0.
