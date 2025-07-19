/**
 * @jest-environment jsdom
 */
import { jest } from '@jest/globals';
import { GameTable } from '../../../public/js/components/GameTable.js';
import { Dashboard } from '../../../public/js/components/Dashboard.js';
import { getMockTemplate } from '../helpers/mockTemplates.js';
import { QuestionService } from '../../../public/js/services/QuestionService.js';

describe('Game table', () => {
  it('renders rows from service into table', async () => {
    document.body.innerHTML = getMockTemplate();
    const questionService = new QuestionService('http://fakeurl');
    jest.spyOn(questionService, 'getQuestionJsonArray').mockResolvedValue([
      { question: 'Is it an object that uses in everyday?', answer: 'no' },
      {
        question: 'Is it an object that uses in a special occasions?',
        answer: 'yes',
      },
    ]);
    const tableObj = new GameTable(new Dashboard(), questionService);
    await tableObj.loadGame();
    const rows = document.querySelectorAll('#dashboard .game-table tbody tr');
    const cols = rows[0].querySelectorAll('td');
    expect(rows.length).toBe(2);
    expect(cols[1].textContent).toContain(
      'Is it an object that uses in everyday?'
    );
    expect(cols[2].textContent).toContain('no');
  });
});
