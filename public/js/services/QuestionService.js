export class QuestionService {
  #endpoint = 'question';

  /**
   * Constructor for the QuestionService
   * @param {string} baseUrl - The base URL for the API
   * This service is responsible for handling question-related operations.
   */
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  /**
   * Ask a question to the backend service
   * @param {string} question
   * @returns json {
   *  ok: boolean,
   *  error: string|null,
   *  questions: [
   *    {id: string, question: string, answer: boolean}
   *  ]
   * }
   */
  async askQuestion(question) {
    try {
      const inputData = new URLSearchParams();
      inputData.append('question', question);
      const response = await fetch(`${this.baseUrl}/${this.#endpoint}-ask`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: inputData.toString(),
      });

      if (!response.ok) {
        throw new Error(`Error asking question: ${response.statusText}`);
      }
      const data = await response.json();
      if (data.error) {
        throw new Error(`Error from server: ${data.error}`);
      }
      return data;
    } catch (error) {
      console.error('Failed to ask question:', error);
    }
  }
}
