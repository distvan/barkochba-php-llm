/**
 * @jest-environment jsdom
 */
import userEvent from '@testing-library/user-event';
import { Dashboard } from '../../../public/js/components/Dashboard.js';
import { getMockTemplate } from '../helpers/mockTemplates.js';
import { CategoryOptionSelector } from '../../../public/js/components/CategoryOptionSelector.js';
import expect from 'expect';

describe('Category option selector', () => {
  let selector;
  const testCases = ['organism', 'object', 'concept'];
  beforeEach(() => {
    document.body.innerHTML = getMockTemplate();
  });

  test.each(testCases)('category option is selected', async (item) => {
    selector = new CategoryOptionSelector(new Dashboard());
    const optionItem = document.querySelector('.option.' + item);
    await userEvent.click(optionItem);
    expect(selector.getSelected()).toBe(item);
  });

  it('tests the option selected function', async () => {
    const item = 'object';
    selector = new CategoryOptionSelector(new Dashboard());
    selector.setSelected(item);
    const selectedItem = document.querySelectorAll('.option.selected');
    expect(selector.getSelected()).toBe(item);
    expect(selectedItem.length).toEqual(1);
  });
});
