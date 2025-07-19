import { jest } from '@jest/globals';
import { QuestionService } from '../../../public/js/services/QuestionService';
import expect from 'expect';

global.fetch = jest.fn();

describe('Question service', () => {
  afterEach(() => {
    fetch.mockClear();
  });

  it('should receive a list of questions connecting to the actual game', async () => {
    const mockData = [
      {
        question: 'Is it a living person?',
        answer: 'yes',
      },
    ];
    fetch.mockResolvedValueOnce({
      ok: true,
      json: async () => mockData,
    });

    const questionService = new QuestionService('http://fakeurl');
    let result = await questionService.getQuestionJsonArray();

    expect(Array.isArray(result)).toBe(true);
    expect(result).toHaveLength(1);
  });
});
