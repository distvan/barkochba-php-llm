import { jest } from '@jest/globals';
import { GameHistoryService } from '../../../public/js/services/GameHistoryService';
import expect from 'expect';

global.fetch = jest.fn();

describe('Game history service', () => {
  afterEach(() => {
    fetch.mockClear();
  });

  it('should receive a list of game history', async () => {
    const mockData = [
      {
        name: 'John Doe',
        start: '2025-07-15 10:00:00',
        end: '2025-07-15 10:15:00',
        score: 42,
      },
      {
        name: 'Jane Doe',
        start: '2025-07-18 10:00:00',
        end: '2025-07-18 10:15:00',
        score: 45,
      },
    ];
    fetch.mockResolvedValueOnce({
      ok: true,
      json: async () => mockData,
    });

    const gameHistoryService = new GameHistoryService('http://fakeurl');
    let result = await gameHistoryService.getGameDataJsonArray();

    expect(Array.isArray(result)).toBe(true);
    expect(result).toHaveLength(2);
  });
});
