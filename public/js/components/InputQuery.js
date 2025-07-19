import { Dashboard } from './Dashboard.js';
import { DashboardElement } from './DashboardElement.js';

/**
 * Class represents an InputQuery element
 * @extends DashboardElement
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class InputQuery extends DashboardElement {
  /**
   * Constructor
   * @param {Dashboard} dashboard
   */
  constructor(dashboard) {
    super(dashboard);
    this.element = this.dashboard.container.querySelector('.query-input');
  }
}
