export function getMockTemplate() {
  return `
    <div id="dashboard" data-api-url="http://fakeurl">
        <div class="option-selector">
            <div data-value="organism" class="option organism selected">Living being</div>
            <div data-value="object" class="option object">Object</div>
            <div data-value="concept" class="option concept">Concept</div>
        </div>
        <div class="actions">
            <button data-action="newGame" class="new-game-btn">New Game</button>
            <button data-action="startGame" class="start-game-btn">Start Game</button>
        </div>

        <div class="gameboard">
            <div class="input-wrapper">
                <input type="text" placeholder="Ask a relevant question!" />
                <button id="submitQuestionButton" data-action="ask" aria-label="Send">
                    <svg viewBox="0 0 24 24">
                        <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                    </svg>
                </button>
            </div>
            <button id="iKnowButton" data-action="iKnow" aria-label="I know">
                <span class="btn__text">I know It!</span>
            </button>
            <table class="game-table">
                <thead>
                    <tr>
                        <th>Round</th>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <table class="score-table">
            <thead>
                <tr>
                    <th>Place</th>
                    <th>Name</th>
                    <th>Game Start</th>
                    <th>Game End</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div id="guessModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Guess the answer</h2>
                <p>What is your guess?</p>
                <input type="text" id="guessInput" placeholder="Type your guess here..." />
                <button id="submitGuessButton" data-action="submitGuess">Submit Guess</button>
            </div>
        </div>
    </div>
    `;
}
