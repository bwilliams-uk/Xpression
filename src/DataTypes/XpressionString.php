<?php
// String Container Class for Expression Text.

namespace Williams\Xpression\DataTypes;
class XpressionString
{
	private string $currentText;
	private string $originalText;
	private array $history = [];

	public function __construct(string $text)
	{
		$this->setCurrentText($text);
		$this->originalText = $text;
	}

	// Get the current text value.
	public function currentText() : string
	{
		return $this->currentText;
	}

	// Get an array of previous text values.
	public function history() : array
	{
		return $this->history;
	}

	// Replace the first occurense of a substring in current text.
	public function replaceFirst($search, $replace) : void
	{
		$index = strpos($this->currentText(), $search);
		$length = strlen($search);
		if (is_int($index)) {
			$this->setCurrentText(substr_replace($this->currentText, $replace, $index, $length));
		}
	}

	// Replace all occurenses of a substring in current text.
	public function replaceAll($search, $replace) : void
	{
		$this->setCurrentText(str_replace($search, $replace, $this->currentText));
	}

	// Resets current text to its initial state.
	public function reset() : void
	{
		$this->setCurrentText($this->originalText);
	}

	// Returns first match of the specified pattern as an array of subgroups. False if no match.
	public function match($pattern) : array | false
	{
		$success = preg_match($pattern, $this->currentText, $match);
		return ($success) ? $match : false;
	}

	// Returns count of a substring in current text.
	public function substringCount($substring) : int
	{
		return substr_count($this->currentText(),$substring);
	}

	// Converts current text to lowercase.
	public function lowercase() : void
    {
        $this->setCurrentText(strtolower($this->currentText()));
    }

	// Removes whitespace from current text.
    public function removeWhitespace() : void
    {
        $this->replaceAll(' ', '');
    }

	// Sets the current text (and updates history).
	protected function setCurrentText($text) : void
	{
		$this->currentText = $text;
		if (end($this->history) != $text) {
			$this->history[] = $text;
		}
	}
}
