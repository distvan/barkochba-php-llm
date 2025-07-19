/**
 * Class represents a GameHistoryService
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class GameHistoryService {
  #endpoint = '/game-history';
  /**
   * Constructor
   * @param {string} baseUrl
   */
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  /**
   * getGameDataJsonArray
   * @returns array
   */
  async getGameDataJsonArray() {
    try {
      const response = await fetch(`${this.baseUrl}${this.#endpoint}`, {
        headers: { Accept: 'application/json' },
      });

      if (!response.ok) {
        throw new Error(`HTTP error ${response.status}`);
      }

      const data = await response.json();

      if (!Array.isArray(data)) {
        throw new Error('Expected a JSON array');
      }

      return data;
    } catch (error) {
      console.error('API fetch error:', error);
      return [];
    }
  }
}
