import { DashboardElement } from './DashboardElement.js';

export class GuessModal extends DashboardElement {
  constructor(dashboard) {
    super(dashboard);
    this.modal = document.getElementById('guessModal');
    this.guessButton = document.getElementById('iKnowButton');
    this.closeBtn = this.modal.querySelector('.close');
    this.submitGuessButton = document.getElementById('submitGuessButton');
    this.guessInput = document.getElementById('guessInput');
    this.guessButton.addEventListener(
      'click',
      this.guessButtonOnClick.bind(this)
    );
    this.closeBtn.addEventListener('click', this.closeButtonOnClick.bind(this));
    this.submitGuessButton.addEventListener(
      'click',
      this.submitGuessButtonOnClick.bind(this)
    );
  }

  guessButtonOnClick() {
    this.modal.style.display = 'block';
    this.guessInput.focus();
  }
  closeButtonOnClick() {
    this.modal.style.display = 'none';
  }
  submitGuessButtonOnClick() {
    const guess = this.guessInput.value.trim();
    if (guess) {
      this.dashboard.emit('guessSubmitted', guess);
      this.guessInput.value = '';
      this.modal.style.display = 'none';
    } else {
      alert('Please enter a guess.');
    }
  }
}
