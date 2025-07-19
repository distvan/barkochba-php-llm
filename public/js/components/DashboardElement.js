import { Dashboard } from './Dashboard.js';

/**
 * Class represents a Dashboard element
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class DashboardElement {
  /**
   * Constructor
   * @param {Dashboard} dashboard
   */
  constructor(dashboard) {
    this.dashboard = dashboard;
    this.element = null;
  }

  /**
   * Hide the element
   */
  hide() {
    this.element.style.display = 'none';
  }

  /**
   * Show the element
   */
  show() {
    this.element.style.display = 'block';
  }
}
