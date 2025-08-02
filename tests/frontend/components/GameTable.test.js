/**
 * @jest-environment jsdom
 */
import { GameTable } from '../../../public/js/components/GameTable.js';
import { Dashboard } from '../../../public/js/components/Dashboard.js';
import { getMockTemplate } from '../helpers/mockTemplates.js';

describe('Game table', () => {
  it('renders rows from service into table', () => {
    document.body.innerHTML = getMockTemplate();
    const testData = [
      { question: 'Is it an object that uses in everyday?', answer: false },
      {
        question: 'Is it an object that uses in a special occasions?',
        answer: true,
      },
    ];
    const tableObj = new GameTable(new Dashboard());
    tableObj.loadGame(testData);
    const rows = document.querySelectorAll('#dashboard .game-table tbody tr');
    const colsCase1 = rows[0].querySelectorAll('td');
    const colsCase2 = rows[1].querySelectorAll('td');
    expect(rows.length).toBe(2);
    expect(colsCase1[1].textContent).toContain(
      'Is it an object that uses in everyday?'
    );
    expect(colsCase1[2].textContent).toContain('No');
    expect(colsCase2[1].textContent).toContain(
      'Is it an object that uses in a special occasions?'
    );
    expect(colsCase2[2].textContent).toContain('Yes');
  });
});
