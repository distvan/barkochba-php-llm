/**
 * @jest-environment jsdom
 */
import { jest } from '@jest/globals';
import { ScoreTable } from '../../../public/js/components/ScoreTable.js';
import { Dashboard } from '../../../public/js/components/Dashboard.js';
import { GameService } from '../../../public/js/services/GameService.js';
import { getMockTemplate } from '../helpers/mockTemplates.js';

describe('Score table', () => {
  it('renders rows from service into table', async () => {
    document.body.innerHTML = getMockTemplate();
    const gameService = new GameService('http://fakeurl');
    jest.spyOn(gameService, 'getGameDataJsonArray').mockResolvedValue([
      {
        name: 'Jane Doe',
        start: '2025-07-10 10:00:00',
        end: '2025-07-16 08:15:10',
        score: 45,
      },
      {
        name: 'John Doe',
        start: '2025-07-15 10:00:00',
        end: '2025-07-19 11:15:10',
        score: 42,
      },
    ]);
    const tableObj = new ScoreTable(new Dashboard(), gameService);
    await tableObj.refresh();
    const rows = document.querySelectorAll('#dashboard .score-table tbody tr');
    const cols = rows[0].querySelectorAll('td');
    expect(rows.length).toBe(2);
    expect(cols[0].textContent).toContain('1.');
    expect(cols[1].textContent).toContain('Jane Doe');
    expect(cols[2].textContent).toContain('2025-07-10 10:00:00');
    expect(cols[3].textContent).toContain('2025-07-16 08:15:10');
    expect(cols[4].textContent).toContain('45');
  });
});
