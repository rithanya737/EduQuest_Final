# India States Game — Web Version

A browser port of the original Python turtle-graphics "guess the Indian state" game.
Type a state's name; if it's correct, its label appears on the map. Get all 28 to win.

## Files

- `index.html` — the page structure (form, map, score, end screen).
- `style.css` — all the visual styling.
- `states.js` — the data: each state's name and where its label goes on the map (as % position).
- `script.js` — the game logic (checking guesses, updating the score, showing labels).
- `assets/india-map.gif` — the blank outline map (same image used in the Python version).

## HTML elements/features used, and why

- **`<form>` + `<input type="text">` + `<button>`** — the standard way to take typed input
  from a user in HTML. Using a real `<form>` (instead of just a text box) means the guess
  is also submitted when the user presses **Enter**, not just by clicking the button.
- **`<label for="...">`** — links the label text to the input box, which is both an
  accessibility good practice and lets clicking the label focus the input.
- **`<div id="map-container">` with `position: relative`** — a wrapper around the map image.
  Making it `position: relative` turns it into the positioning frame for the state-name
  labels, which are placed with `position: absolute` and a `left`/`top` percentage.
  This is the key CSS trick that recreates what `turtle.goto()` + `turtle.write()` did
  in the Python version, but with plain HTML elements instead of turtle graphics.
- **`<span class="state-label">`** — one of these gets created (in JavaScript, with
  `document.createElement`) for every state you guess correctly, and dropped onto the map
  at that state's coordinate.
- **`<section id="end-screen">`, hidden by default** — shown only once the game ends
  (win or give up), listing whatever states weren't found. CSS `display: none` /
  toggling a `.hidden` class is the standard way to show/hide content without reloading
  the page.
- **Flexbox (`display: flex`)** — used in `main` to lay the controls and the map
  side-by-side on wide screens, and it wraps to stack on narrow/mobile screens
  automatically, so no separate mobile layout code was needed.
- **CSS `aspect-ratio: 1 / 1`** — keeps the map container square (matching the
  600×600 source image) at any width, so the state labels (positioned by percentage)
  always land in the right spot regardless of screen size.

## JavaScript concepts used, and why

- **`STATES` array of objects** (`states.js`) — replaces the `states_names.csv` file.
  Each object is `{ name, left, top }`. Kept in its own file, separate from the game
  logic, so it's easy to swap in a different country's states/coordinates later.
- **`array.find()`** — looks through `STATES` for the one whose name matches what the
  user typed (case-insensitively), replacing the Python `if user_answer in state_list`
  check.
- **`event.preventDefault()`** on the form's `submit` event — stops the browser's
  default behaviour of reloading the page when a form is submitted, since we want to
  handle the guess with JavaScript instead.
- **`classList.add/remove/toggle`** — the standard way to change an element's appearance
  or visibility by adding/removing CSS classes (e.g. showing feedback in green for a
  correct guess, red for wrong; hiding/showing the end screen).
- **Coordinate conversion (in `states.js` comments)** — the original turtle coordinates
  were centered on (0,0) with a y-axis that increases *upward*. CSS positions are
  measured from the top-left corner with y increasing *downward*, so each coordinate
  was converted once (`left% = (300 + x) / 600 * 100`, `top% = (300 - y) / 600 * 100`)
  to line up correctly on screen.

## Running it

No build step or server needed — just open `index.html` in a browser. Everything
(HTML, CSS, JS, image) is a plain static file, so this folder can also be dropped
straight into GitHub Pages, Netlify, or any static web host later.

## Possible next steps

- Add this game as one tile on a larger "learn about India" games landing page.
- Add a timer or a hint button.
- Once a backend exists: save best scores / missed-states lists per user.
