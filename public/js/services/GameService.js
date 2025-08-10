export class GameService {
  #endpoint = '/game';

  /**
   * Constructor for the GameService
   * This service is responsible for handling game-related operations.
   * @param {string} baseUrl - The base URL for the API
   */
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  /**
   * Start a new game with the selected category
   * This method sends a POST request to the backend to start a game.
   * @param {string} category
   * @returns {Promise<Object>} - The response data from the server
   * @throws {Error} - If the fetch operation fails or the response is not ok
   */
  async startGame(category) {
    try {
      const inputData = new URLSearchParams();
      inputData.append('category', category);

      const response = await fetch(`${this.baseUrl}${this.#endpoint}-start`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: inputData.toString(),
      });

      if (!response.ok) {
        throw new Error(`HTTP error ${response.status}`);
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('API fetch error:', error);
      return [];
    }
  }

  /**
   * getGameDataJsonArray
   * @returns array
   */
  async getGameDataJsonArray() {
    try {
      const response = await fetch(`${this.baseUrl}${this.#endpoint}-history`, {
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
      const response = await fetch(`${this.baseUrl}${this.#endpoint}-pending`, {
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
