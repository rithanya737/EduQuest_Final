# Bharat Crossword

A browser-based crossword puzzle game about India, built with **plain HTML5, CSS3 and JavaScript only** — no frameworks, no libraries, no build tools.

## What it does

- A bank of **80 India-related clues** (history, geography, culture, food, festivals, sports, language, space missions, etc.) is stored in a JavaScript array.
- Every time you start a game or click **New Puzzle**, **12 clues are picked at random** from that bank and arranged into a real **interlocking crossword grid** (words cross each other like a newspaper crossword) — the layout is generated fresh in the browser each time, so the puzzle is almost never the same twice.
- Clues already used are tracked for the length of the browser session, so **the same clue will not repeat** until all 80 have appeared at least once (after which the tracker resets automatically).
- You can type letters directly into the grid, jump to a word by clicking its clue, move around with the arrow keys, check your answers, reveal a letter as a hint, and see a live timer and score.

## Files

| File | Purpose |
|---|---|
| `index.html` | Page structure and content |
| `style.css` | All styling (external stylesheet) |
| `script.js` | All game logic |
| `README.md` | This file |

Open `index.html` in any modern browser to play — no server or installation needed.

## How it maps to what was taught (Units I–III)

### Unit I — HTML5
- **Headings** (`h1`–`h3`) structure the page (title, section headings, "Across"/"Down").
- **Lists**: the instructions are an ordered list (`<ol>`), and the Across/Down clues are ordered lists built dynamically by JavaScript.
- **Tables**: the crossword grid itself is a real `<table>` (rows/cells, like a proper grid), and the stats bar (time / words placed / score) is also a small table.
- **Images**: an inline SVG tricolor flag icon is used in the header via an `<img>` tag.
- **Internal linking**: the top navigation links to page sections (`#instructions`, `#start-screen`, `#about`), and every clue in the Across/Down lists is an `<a href="#cell-row-col">` link that jumps to and focuses the matching square in the grid.
- **Forms**: a form collects the player's name before the game starts, and the on-screen controls (Check Answers / Reveal / New Puzzle) are `<button>` elements wired to the form's data.

### Unit II — CSS3
- Stylesheet is **external** (`style.css`, linked with `<link>`), keeping HTML and CSS separate.
- **Box model**: padding, margin, and `box-sizing: border-box` are used throughout the cards, buttons, and grid cells.
- **Positioning**: each crossword cell uses `position: relative` with an absolutely positioned (`position: absolute`) clue-number label in the corner — the classic crossword-numbering technique — controlled with `z-index` so the number sits above the input box.
- **Backgrounds**: a soft tricolor-inspired gradient background, solid card backgrounds, and colour-coded states (correct/incorrect cells).
- **Text-shadow / box-shadow**: used on the main heading and on cards/buttons for depth.
- **Transitions**: buttons, links and input focus states animate smoothly (`transition` on colour/transform/box-shadow).
- **Animations**: a `fadeIn` keyframe animation on each section as it appears, plus `pop` and `shake` keyframe animations when a letter is marked correct or incorrect.

### Unit III — JavaScript
- **Prompt dialogs**: `prompt()` is used when revealing a hint with nothing selected (asks for a clue number), `confirm()` is used before discarding progress for a new puzzle and after finishing a puzzle, and `alert()` style feedback is shown through the on-page status message.
- **Control statements**: `if / else`, `for`, and array iteration (`forEach`, `filter`, `map`, `find`) drive the crossword-generation algorithm, grid rendering, and answer checking.
- **Functions**: the logic is broken into small, named functions — `pickRoundWords()`, `generatePuzzle()`, `canPlaceWord()`, `renderGrid()`, `renderClues()`, `checkAnswers()`, `startTimer()`, and more — each with a single responsibility.
- **Arrays**: the 80-clue question bank, the 12 words chosen per round, and the list of placed words are all plain arrays of objects.
- **Objects**: each clue is `{ word, clue }`; each placed word becomes `{ word, clue, row, col, dir, number }`; each grid cell is tracked as an object holding its input element and the word(s) that pass through it.
- **DOM manipulation**: the entire grid and clue lists are built at runtime with `document.createElement`, `classList`, and `dataset`, rather than being hard-coded in the HTML.
- **Event handling**: `submit` (start form), `click` (clue links, buttons), `input` (typing a letter, with a small regular expression `/[^a-zA-Z]/g` to strip anything that isn't a letter), `focus`, and `keydown` (arrow-key navigation between cells) are all handled.

## How the crossword is generated (short version)

1. Twelve clues are picked at random from the ones not yet used this session.
2. The longest word is placed first, in the middle of a large empty grid.
3. Each following word is scanned letter-by-letter against every letter already on the grid; wherever a matching letter is found, the algorithm checks whether the new word can cross there without breaking any existing word (no letter clashes, no two words touching side-by-side by accident). The first valid spot found is used.
4. Once all words have been attempted, the empty rows/columns around the used area are trimmed away, every word's starting square is numbered in reading order, and the grid + clue lists are rendered to the page.

This keeps the puzzle genuinely different each time while staying simple enough to read and explain — no external crossword-generation library was used.

## Notes / limitations

- Because placement is random, not every one of the 12 chosen clues is guaranteed to fit in a given round (a clue that can't be connected to the rest is simply skipped for that round and may appear in a later one); the "Words placed" counter shows how many made it into the grid.
- All game state (used clues, current puzzle, score, timer) lives in memory in the browser tab and resets if the page is reloaded — no data is saved to a server or to local storage.
