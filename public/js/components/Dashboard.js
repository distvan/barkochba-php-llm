import { NewGameButton } from './NewGameButton.js';
import { ScoreTable } from './ScoreTable.js';
import { GameTable } from './GameTable.js';
import { EventEmitter } from './EventEmitter.js';
import { CategoryOptionSelector } from './CategoryOptionSelector.js';
import { GameHistoryService } from '../services/GameHistoryService.js';
import { GameStartService } from '../services/GameStartService.js';
import { QuestionService } from '../services/QuestionService.js';
import { InputQuery } from './InputQuery.js';
import { StartGameButton } from './StartGameButton.js';
import { GuessModal } from './GuessModal.js';

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
    this.startGameButton = new StartGameButton(this);
    this.gameStartService = new GameStartService(this.apiUrl);
    this.questionService = new QuestionService(this.apiUrl);
    this.inputQuery = new InputQuery(this);
    this.scoreTable = new ScoreTable(this, new GameHistoryService(this.apiUrl));
    this.gameTable = new GameTable(this);
    this.optionSelector = new CategoryOptionSelector(this);
    this.guessModal = new GuessModal(this);
    this.on('guessSubmitted', (guess) => this.guessSubmitted(guess));
    this.on('newGameClicked', () => this.newGameClicked());
    this.on('questionAsked', (question) => this.questionAsked(question));
    this.on('startGameClicked', () => this.startGameClicked());
  }

  /**
   * Create a new game, record the time on the backend and
   * show an input box to enter the question
   */
  newGameClicked() {
    this.newGameButton.hide();
    this.optionSelector.show();
    this.scoreTable.hide();
    this.gameTable.hide();
    this.startGameButton.show();
  }

  questionAsked(question) {
    this.questionService.askQuestion(question).then((data) => {
      if (data.ok) {
        this.gameTable.loadGame(data.questions);
        this.inputQuery.clear();
      }
    });
  }

  guessSubmitted(guess) {
    //TODO: Implement the logic to handle the guess submission
  }

  async startGameClicked() {
    const selected = this.optionSelector.getSelected();
    const data = await this.gameStartService.startGame(selected);
    if (data.result === 'started') {
      this.startGameButton.hide();
      this.optionSelector.hide();
      this.gameTable.show();
      this.inputQuery.show();
    }
  }

  /**
   * The dashboard related services call that
   * @returns {string} apiUrl - the endpoint URL
   */
  getApiUrl() {
    return this.apiUrl;
  }
}
