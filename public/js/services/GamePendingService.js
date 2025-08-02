/**
 * Class represents a GamePendingService
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class GamePendingService {
  #endpoint = '/game-pending';
  /**
   * Constructor
   * @param {string} baseUrl
   */
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  /**
   * getPendingGame
   * @returns Json {
   *    result: {
   *        category: '<selected category name>',
   *        questions: [
   *          {id: '', question: '', answer: ''}
   *        ]
   *    }
   * }
   */
  async getPendingGame() {
    try {
      const response = await fetch(`${this.baseUrl}${this.#endpoint}`, {
        headers: { Accept: 'application/json' },
      });

      if (!response.ok) {
        throw new Error(`HTTP error ${response.status}`);
      }

      const data = await response.json();

      return data.result;
    } catch (error) {
      console.error('API fetch error:', error);
      return [];
    }
  }
}
