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
   */
  constructor(dashboard) {
    super(dashboard);
    this.element = this.dashboard.container.querySelector('.game-table');
    this.tbody = this.element.querySelector('tbody');
    this.hide();
  }

  /**
   * Show data content (already asked questions and answers)
   */
  async loadGame(data) {
    if (Array.isArray(data) && data.length !== 0) {
      this.tbody.innerHTML = '';
      let number = 0;
      data.forEach((item) => {
        number++;
        const row = document.createElement('tr');

        const roundCell = document.createElement('td');
        roundCell.textContent = `${number}.`;

        const questionCell = document.createElement('td');
        questionCell.textContent = item.question;

        const answerCell = document.createElement('td');
        answerCell.textContent = this.#getAnswer(item.answer);

        row.appendChild(roundCell);
        row.appendChild(questionCell);
        row.appendChild(answerCell);

        this.tbody.appendChild(row);
      });
    }
  }

  #getAnswer(value) {
    return value ? 'Yes' : 'No';
  }
  /**
   * Show the element
   */
  show() {
    this.element.style.display = 'inline-table';
  }
}
