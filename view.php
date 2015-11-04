<?php
class View {

private $html;
private $placeholdersToRemove = [];

/**
 * Loads an HTML file from the html directory and injects static variables
 * where provided.
 *
 * @param string $viewName The name of the HTML file to load
 * @param array $params Optional. Key-value-pairs of variables to inject into 
 * the HTML
 * 
 * @return string The HTML to output
 */
public function __construct($viewName, $params = []) {
	$this->html = file_get_contents("html/$viewName.html");
	$this->injectParameters($params);
}

public function injectParameters($params) {
	foreach ($params as $key => $value) {
		$this->html = preg_replace("/($key)/", $value, $this->html);
	}
}

/**
 * Injects another HTML view into this one.
 *
 * @param string $placeholder The placeholder text to look for in the currently
 * loaded view
 * @param string $viewName The name of the new view to inject
 * @param array $params Optional. Key-value-pairs of variables to inject into
 * the HTML
 */
public function injectSubView($placeholder, $viewName, $params = []) {
	// First, load the sub-view.
	$viewHTML = file_get_contents("html/$viewName.html");

	// Second, inject any parameters into the sub-view's HTML.
	foreach ($params as $key => $value) {
		$viewHTML = preg_replace("/($key)/", $value, $viewHTML);
	}

	// Finally, inject this sub-view into the current view.
	// Keep the placeholder in place, but mark it for removal upon render.
	$this->html = str_replace(
		$placeholder, 
		$viewHTML . $placeholder,
		$this->html
	);
	$this->placeholdersToRemove []= $placeholder;
}

/**
 * Outputs the HTML to the page and terminates.
 */
public function render() {
	// Firstly, remove any placeholders from the HTML that have been used.
	foreach ($this->placeholdersToRemove as $placeholder) {
		$this->html = str_replace($placeholder, "", $this->html);
	}

	// Then render the HTML to the browser.
	echo $this->html;
	exit;
}

}#