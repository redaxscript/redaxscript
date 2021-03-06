Cypress.Commands.add('installDatabase', () => console('install database --admin-name=Test --admin-user=test --admin-password=aaAA00AAaa --admin-email=test@redaxscript.com'));

Cypress.Commands.add('uninstallDatabase', () => console('uninstall database'));

Cypress.Commands.add('installTestDummy', () => console('install module --alias=TestDummy'));

Cypress.Commands.add('uninstallTestDummy', () => console('uninstall module --alias=TestDummy'));

Cypress.Commands.add('setSetting', (key, value) => console('setting set --key=' + key + ' --value=' + value));

Cypress.Commands.add('setConfig', () => console('config set --db-type=sqlite --db-host=build/test.sqlite --db-prefix=_test'));

Cypress.Commands.add('resetConfig', () => console('config reset'));

Cypress.Commands.add('login', () => console('auth login --user=test --password=aaAA00AAaa'));

Cypress.Commands.add('logout', () => console('auth logout'));

/**
 * console
 *
 * @since 4.5.0
 *
 * @param {string} argv
 *
 * @return {Promise}
 */

function console(argv)
{
	return cy.request(
	{
		method: 'POST',
		url: 'http://localhost:8000/console.php',
		credentials: 'same-origin',
		headers:
		{
			'Content-Type': 'application/json',
			'X-Requested-With': 'XMLHttpRequest'
		},
		retryOnStatusCodeFailure: true,
		body:
		{
			argv
		}
	});
}
