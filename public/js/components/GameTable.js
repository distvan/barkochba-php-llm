import { QuestionService } from '../services/QuestionService.js';
import { Dashboard } from './Dashboard.js';
import { DashboardElement } from './DashboardElement.js';

/**
 * Class represents a GameTable
 * @extends DashboardElement
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class GameTable extends DashboardElement {
  /**
   * Constructor
   * @param {Dashboard} dashboard
   * @param {QuestionService} questionService
   */
  constructor(dashboard, questionService) {
    super(dashboard);
    this.questionService = questionService;
    this.element = this.dashboard.container.querySelector('.game-table');
    this.tbody = this.element.querySelector('tbody');
    this.hide();
  }

  /**
   * Load already asked questions and answers
   */
  async loadGame() {
    const data = await this.questionService.getQuestionJsonArray();
    if (Array.isArray(data) && data.length !== 0) {
      let number = 0;
      data.forEach((item) => {
        number++;
        const row = document.createElement('tr');

        const roundCell = document.createElement('td');
        roundCell.textContent = `${number}.`;

        const questionCell = document.createElement('td');
        questionCell.textContent = item.question;

        const answerCell = document.createElement('td');
        answerCell.textContent = item.answer;

        row.appendChild(roundCell);
        row.appendChild(questionCell);
        row.appendChild(answerCell);

        this.tbody.appendChild(row);
      });
    }
  }

  /**
   * Show the element
   */
  show() {
    this.element.style.display = 'inline-table';
  }
}
