import { NewGameButton } from './NewGameButton.js';
import { ScoreTable } from './ScoreTable.js';
import { GameTable } from './GameTable.js';
import { EventEmitter } from './EventEmitter.js';
import { CategoryOptionSelector } from './CategoryOptionSelector.js';
import { GameHistoryService } from '../services/GameHistoryService.js';
import { QuestionService } from '../services/QuestionService.js';

/**
 * Represents the Dashboard controller class
 * @extends EventEmitter
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class Dashboard extends EventEmitter {
  /**
   * Initialize the dashboard elements
   * @param {string} containerId
   */
  constructor(containerId = 'dashboard') {
    super();
    this.container = document.getElementById(containerId);
    this.apiUrl = this.container.dataset.apiUrl;
    this.newGameButton = new NewGameButton(this);
    this.scoreTable = new ScoreTable(this, new GameHistoryService(this.apiUrl));
    this.gameTable = new GameTable(this, new QuestionService(this.apiUrl));
    this.optionSelector = new CategoryOptionSelector(this);
    this.on('newGameClicked', () => this.newGameClicked());
  }

  /**
   * Create a new game, record the time on the backend and
   * show an input box to enter the question
   */
  newGameClicked() {
    this.newGameButton.hide();
    this.optionSelector.hide();
    this.scoreTable.hide();
  }

  /**
   * The dashboard related services call that
   * @returns {string} apiUrl - the endpoint URL
   */
  getApiUrl() {
    return this.apiUrl;
  }
}
