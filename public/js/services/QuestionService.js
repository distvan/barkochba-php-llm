/**
 * Class represents a QuestionService
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class QuestionService {
  #endpoint = '/questionlist';

  /**
   * Constructor
   * @param {string} baseUrl
   */
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  /**
   * getQuestionJsonArray
   * @returns array
   */
  async getQuestionJsonArray() {
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
