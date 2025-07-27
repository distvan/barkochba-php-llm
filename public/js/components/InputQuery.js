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
    this.element = this.dashboard.container.querySelector('.input-wrapper');
    this.button = this.dashboard.container.querySelector('[data-action="ask"]');
    this.button.addEventListener('click', this.onClick.bind(this));
    this.input = this.element.querySelector('input');
    this.input.addEventListener('keydown', this.onKeyDown.bind(this));
    this.hide();
  }

  onClick(event) {
    const inputValue = this.input.value.trim();
    if (inputValue !== '' && inputValue.length > 5) {
      this.dashboard.emit('questionAsked', this.input.value);
    }
  }
  onKeyDown(event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      this.button.click();
    }
  }
  show() {
    this.element.style.display = 'flex';
  }
}
