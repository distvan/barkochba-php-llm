/**
 * Class represents a GameStartService
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class GameStartService {
  #endpoint = '/game-start';
  /**
   * Constructor
   * @param {string} baseUrl
   */
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  async startGame(category) {
    try {
      const inputData = new URLSearchParams();
      inputData.append('category', category);

      const response = await fetch(`${this.baseUrl}${this.#endpoint}`, {
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
}
