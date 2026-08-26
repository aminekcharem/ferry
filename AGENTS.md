# AGENTS.md

## Project

Application web professionnelle.

Stack:
- Laravel
- MySQL
- Tailwind CSS
- Alpine.js
- Vite

## Architecture

- Controllers must remain lightweight
- Business logic goes into Services
- Use Form Requests for validation
- Use Eloquent relationships
- Avoid duplicated queries
- Avoid N+1 queries

## Frontend

Always reuse existing components before creating new ones.

Responsive breakpoints:
- Mobile: 320-767
- Tablet: 768-1023
- Desktop: 1024+

All pages must work on:
- mobile
- tablet
- desktop

## UI / UX

Keep the existing design system consistent.

Use:
- consistent spacing
- consistent border radius
- consistent typography
- clear visual hierarchy

Avoid:
- excessive gradients
- unnecessary animations
- inconsistent button styles
- duplicated CSS
- inline styles

## Before modifying UI

1. Inspect existing components.
2. Identify reusable patterns.
3. Explain proposed changes.
4. Implement changes.
5. Verify responsive behavior.

## Quality

Before completing a task:

- check console errors
- check validation
- check loading states
- check empty states
- check error states
- check mobile layout
- run tests
- run build
