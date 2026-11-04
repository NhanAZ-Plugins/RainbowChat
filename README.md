# RainbowChat

Color Unicode graphemes in Axolotl-PM player chat

[![CI](https://github.com/NhanAZ-Plugins/RainbowChat/actions/workflows/build.yml/badge.svg)](https://github.com/NhanAZ-Plugins/RainbowChat/actions/workflows/build.yml)
[![Latest release](https://img.shields.io/github/v/release/NhanAZ-Plugins/RainbowChat)](https://github.com/NhanAZ-Plugins/RainbowChat/releases/latest)
[![License](https://img.shields.io/github/license/NhanAZ-Plugins/RainbowChat)](https://github.com/NhanAZ-Plugins/RainbowChat/blob/master/LICENSE)
[![Discord](https://img.shields.io/discord/986553214889517088?label=Discord&logo=discord&logoColor=white&color=5865F2)](https://discord.gg/j2X83ujT6c)


## Requirements

- Axolotl-PM API 5.0.0. The [build workflow](.github/workflows/build.yml) records pinned server revisions and test results. Compatibility with every 5.x revision has not been verified.
- PHP 8.1 or newer, as required by Axolotl-PM 5.

## Installation

Download the PHAR from [GitHub Releases](https://github.com/NhanAZ-Plugins/RainbowChat/releases), place it in the server's `plugins` directory and restart the server.

Other chat plugins can also change `PlayerChatEvent`. Check the combined behavior when using them together. RainbowChat leaves malformed UTF-8 messages unchanged.

## Development and validation

The [build workflow](.github/workflows/build.yml) tests color insertion and Unicode grapheme preservation against pinned Axolotl-PM source revisions. It then uses [DevTools](https://github.com/NhanAZ/DevTools) to run PHPStan at maximum level, build the PHAR and inspect the artifact. Exact tested revisions are recorded in the workflow and its [GitHub Actions runs](https://github.com/NhanAZ-Plugins/RainbowChat/actions).

The tests check event message bytes and inserted color codes. Bedrock client rendering has not been verified.

## Support

Join [NhanAZ Discord](https://discord.gg/j2X83ujT6c) for support.

## License

RainbowChat is distributed under the [GNU General Public License version 3](LICENSE).
