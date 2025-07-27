import { Dashboard } from './components/Dashboard.js';

document.addEventListener('DOMContentLoaded', () => {
  let dashboard = new Dashboard();
  dashboard.scoreTable.refresh();
});
