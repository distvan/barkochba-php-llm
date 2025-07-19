import { Dashboard } from './Dashboard.js';
import { DashboardElement } from './DashboardElement.js';

/**
 * Represents the newGameButton controller class
 * @extends DashboardElement
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class NewGameButton extends DashboardElement {
  /**
   * Initialize the button
   * @param {Dashboard} dashboard
   */
  constructor(dashboard) {
    super(dashboard);
    this.element = this.dashboard.container.querySelector('.new-game-btn');
    this.element.addEventListener('click', this.onClick.bind(this));
  }

  /**
   * Click on the button event
   * @param {*} event
   */
  onClick(event) {
    this.dashboard.emit('newGameClicked');
  }
}
