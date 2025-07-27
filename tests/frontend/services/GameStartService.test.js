import { jest } from '@jest/globals';
import { GameStartService } from '../../../public/js/services/GameStartService';
import expect from 'expect';

global.fetch = jest.fn();

describe('Game start service', () => {
  afterEach(() => {
    fetch.mockClear();
  });

  it('should receive a response from the backend to check the game succesfuly started', async () => {
    const mockData = [
      {
        result: 'started',
      },
    ];
    fetch.mockResolvedValueOnce({
      ok: true,
      json: async () => mockData,
    });

    const gameStartService = new GameStartService('http://fakeurl');
    let result = await gameStartService.startGame();

    expect(Array.isArray(result)).toBe(true);
  });
});
