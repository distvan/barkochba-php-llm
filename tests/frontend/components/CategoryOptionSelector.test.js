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

  beforeEach(() => {
    document.body.innerHTML = getMockTemplate();
  });

  it('checks when organism category option is selected', async () => {
    selector = new CategoryOptionSelector(new Dashboard());
    const optionItem = document.querySelector('.option.organism');
    await userEvent.click(optionItem);
    expect(selector.getSelected()).toBe('organism');
  });

  it('checks when object category option is selected', async () => {
    selector = new CategoryOptionSelector(new Dashboard());
    const optionItem = document.querySelector('.option.object');
    await userEvent.click(optionItem);
    expect(selector.getSelected()).toBe('object');
  });

  it('checks when concept category option is selected', async () => {
    selector = new CategoryOptionSelector(new Dashboard());
    const optionItem = document.querySelector('.option.concept');
    await userEvent.click(optionItem);
    expect(selector.getSelected()).toBe('concept');
  });
});
