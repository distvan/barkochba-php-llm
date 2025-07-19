export function getMockTemplate() {
  return `
    <div id="dashboard" data-api-url="http://fakeurl">
        <div class="option-selector">
            <div data-value="organism" class="option organism selected">Organism</div>
            <div data-value="object" class="option object">Object</div>
            <div data-value="concept" class="option concept">Concept</div>
        </div>
        <div class="actions">
            <button class="new-game-btn">New Game</button>
        </div>

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
    </div>
    `;
}
