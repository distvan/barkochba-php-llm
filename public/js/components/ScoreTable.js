import { GameService } from '../services/GameService.js';
import { Dashboard } from './Dashboard.js';
import { DashboardElement } from './DashboardElement.js';

/**
 * Class represents a ScoreTable
 * @extends DashboardElement
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class ScoreTable extends DashboardElement {
  /**
   * Constructor
   * @param {Dashboard} dashboard
   * @param {GameService} gameService
   */
  constructor(dashboard, gameService) {
    super(dashboard);
    this.gameService = gameService;
    this.element = this.dashboard.container.querySelector('.score-table');
    this.tbody = this.element.querySelector('tbody');
    this.hide();
  }

  /**
   * Regenerate score table tbody
   */
  async refresh() {
    const data = await this.gameService.getGameDataJsonArray();
    if (Array.isArray(data) && data.length !== 0) {
      this.delete();
      this.show();
      let number = 0;
      data.forEach((item) => {
        number++;
        const row = document.createElement('tr');

        const placeCell = document.createElement('td');
        placeCell.textContent = `${number}.`;

        const nameCell = document.createElement('td');
        nameCell.textContent = item.name;

        const startCell = document.createElement('td');
        startCell.textContent = item.start;

        const endCell = document.createElement('td');
        endCell.textContent = item.end;

        const scoreCell = document.createElement('td');
        scoreCell.textContent = item.score;

        row.appendChild(placeCell);
        row.appendChild(nameCell);
        row.appendChild(startCell);
        row.appendChild(endCell);
        row.appendChild(scoreCell);

        this.tbody.appendChild(row);
      });
    }
  }

  /**
   * Removing table cols and rows except header and footer
   */
  delete() {
    this.tbody.innerHTML = '';
  }

  /**
   * Show the element
   */
  show() {
    this.element.style.display = 'table';
  }
}
