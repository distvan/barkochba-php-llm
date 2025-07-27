import { Dashboard } from './Dashboard.js';
import { DashboardElement } from './DashboardElement.js';

/**
 * Represents the StartGameButton controller class
 * @extends DashboardElement
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class StartGameButton extends DashboardElement {
  /**
   * Initialize the button
   * @param {Dashboard} dashboard
   */
  constructor(dashboard) {
    super(dashboard);
    this.element = this.dashboard.container.querySelector('.start-game-btn');
    this.element.addEventListener('click', this.onClick.bind(this));
    this.hide();
  }

  /**
   * Click on the button event
   * @param {*} event
   */
  onClick(event) {
    this.dashboard.emit('startGameClicked');
  }

  /**
   * Show StartGame Button
   */
  show() {
    this.element.style.display = 'inline';
  }
}
