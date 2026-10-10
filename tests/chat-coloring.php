<?php

declare(strict_types=1);

use NhanAZ\RainbowChat\Main;
use pocketmine\event\player\PlayerChatEvent;

$source = $argv[1] ?? null;
if ($source === null || !is_file($source . '/vendor/autoload.php')) {
	fwrite(STDERR, "Usage: php tests/chat-coloring.php /path/to/Axolotl-PM-source\n");
	exit(2);
}
require $source . '/vendor/autoload.php';
require $argv[2] ?? dirname(__DIR__) . '/src/NhanAZ/RainbowChat/Main.php';

$plugin = (new ReflectionClass(Main::class))->newInstanceWithoutConstructor();
$cases = [
	['', 0],
	['Hello', 5],
	["a\u{0301}👩‍💻b", 3],
];
foreach ($cases as [$message, $clusters]) {
	$event = (new ReflectionClass(PlayerChatEvent::class))->newInstanceWithoutConstructor();
	$event->setMessage($message);
	$plugin->onChat($event);
	$output = $event->getMessage();
	if (preg_replace('/§[1-9a-g]/u', '', $output) !== $message
		|| preg_match_all('/§[1-9a-g]/u', $output) !== $clusters) {
		throw new RuntimeException('Chat coloring changed the message or split a grapheme');
	}
}

$invalid = (new ReflectionClass(PlayerChatEvent::class))->newInstanceWithoutConstructor();
$invalid->setMessage("\xFF");
$plugin->onChat($invalid);
if ($invalid->getMessage() !== "\xFF") {
	throw new RuntimeException('Invalid UTF-8 input should remain unchanged');
}

echo "PASS: chat coloring preserves Unicode graphemes\n";
