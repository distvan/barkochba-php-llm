import { GamePendingService } from './services/GamePendingService.js';
import { Dashboard } from './components/Dashboard.js';

const context = {};
document.addEventListener('DOMContentLoaded', onDOMReady.bind(context));

async function onDOMReady() {
  let dashboard = new Dashboard();
  const pendingGameService = new GamePendingService(dashboard.getApiUrl());
  let data = await pendingGameService.getPendingGame();
  if (Array.isArray(data.questions) && data.questions.length === 0) {
    dashboard.scoreTable.refresh();
  } else {
    dashboard.gameTable.loadGame(data.questions);
    dashboard.newGameButton.hide();
    dashboard.newGameButton.hide();
    dashboard.optionSelector.setSelected(data.category);
    dashboard.optionSelector.show();
    dashboard.inputQuery.show();
    dashboard.gameTable.show();
  }
}
