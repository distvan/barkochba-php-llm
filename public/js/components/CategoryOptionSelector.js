import { Dashboard } from './Dashboard.js';
import { DashboardElement } from './DashboardElement.js';

/**
 * Class represents a CategoryOptionSelector
 * @extends DashboardElement
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class CategoryOptionSelector extends DashboardElement {
  /**
   * Constructor,  Initialize the CategoryOptionSelector element
   * @param {Dashboard} dashboard
   */
  constructor(dashboard) {
    super(dashboard);
    this.element = this.dashboard.container.querySelector('.option-selector');
    this.options = this.dashboard.container.querySelectorAll('.option');
    this.options.forEach((option) => {
      option.addEventListener('click', this.onClick.bind(this));
      if (option.classList.contains('selected')) {
        this.selected = option.dataset.value;
      }
    });
    this.hide();
  }

  /**
   * Clicked on an option and selected a game category
   * @param {MouseEvent} event
   */
  onClick(event) {
    this.options.forEach((option) => option.classList.remove('selected'));
    event.target.classList.add('selected');
    this.selected = event.target.dataset.value;
  }

  /**
   * getSelected
   * @returns the selected category name
   */
  getSelected() {
    return this.selected;
  }

  /**
   * Show the element
   */
  show() {
    this.element.style.display = 'flex';
  }
}
