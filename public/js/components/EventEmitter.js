/**
 * Class represents an event emitter
 * @author Istvan Dobrentei <https://www.en.dobrenteiistvan.hu>
 */
export class EventEmitter {
  /**
   * Constructor
   */
  constructor() {
    this.listeners = {};
  }

  /**
   * On
   *
   * @param {*} eventName
   * @param {*} listener
   */
  on(eventName, listener) {
    if (!this.listeners[eventName]) this.listeners[eventName] = [];
    this.listeners[eventName].push(listener);
  }

  /**
   * Emit
   *
   * @param {*} eventName
   * @param {*} data
   */
  emit(eventName, data) {
    (this.listeners[eventName] || []).forEach((fn) => fn(data));
  }
}
