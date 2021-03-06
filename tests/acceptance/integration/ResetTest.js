describe('ResetTest', () =>
{
	before(() =>
	{
		cy.setConfig();
		cy.uninstallDatabase();
		cy.installDatabase();
		cy.setSetting('registration', 1);
	});

	beforeEach(() =>
	{
		Cypress.Cookies.preserveOnce('PHPSESSID');
		cy.visit('http://localhost:8000/?l=en&p=login/reset/abc/1');
	});

	after(() =>
	{
		cy.uninstallDatabase();
		cy.resetConfig();
	});

	context('general', () =>
	{
		it('breadcrumb item should have text', () =>
		{
			cy.get('ul.rs-list-breadcrumb li')
				.should('be.visible')
				.shouldHaveText('reset');
		});

		it('content title should have text', () =>
		{
			cy.get('h2.rs-title-content')
				.should('be.visible')
				.shouldHaveText('password_reset');
		});
	});

	context('validation', () =>
	{
		[
			{
				selector: '#password',
				description: 'password'
			}
		]
		.map(test =>
		{
			it('empty field ' + test.description + ' has error', () =>
			{
				cy.get(test.selector)
					.type('-')
					.clear()
					.should('have.class', 'rs-field-note', 'rs-is-error');
			});

			it('incorrect field ' + test.description + ' has warning', () =>
			{
				cy.get(test.selector)
					.clear()
					.type('-')
					.should('have.class', 'rs-field-note', 'rs-is-warning');
			});
		});

		[
			{
				selector: '#task',
				description: 'task'
			}
		]
		.map(test =>
		{
			it('empty field ' + test.description + ' has error', () =>
			{
				cy.get(test.selector)
					.type('-1')
					.clear()
					.should('have.class', 'rs-field-note', 'rs-is-error');
			});

			it('incorrect field ' + test.description + ' has warning', () =>
			{
				cy.get(test.selector)
					.clear()
					.type('-1')
					.should('have.class', 'rs-field-note', 'rs-is-warning');
			});
		});
	});
});
