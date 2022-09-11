<?php

namespace MediaWiki\Extension\Z17DEV;

use OutputPage, Parser, PPFrame, Skin;

/**
 * Class MW_EXT_Icon
 */
class MW_EXT_Icon
{
  /**
   * Register tag function.
   *
   * @param Parser $parser
   *
   * @return bool
   * @throws \MWException
   */
  public static function onParserFirstCallInit(Parser $parser)
  {
    $parser->setFunctionHook('icon', [__CLASS__, 'onRenderTag'], Parser::SFH_OBJECT_ARGS);

    return true;
  }

  /**
   * Render tag function.
   *
   * @param Parser $parser
   * @param PPFrame $frame
   * @param array $args
   *
   * @return string
   */
  public static function onRenderTag(Parser $parser, PPFrame $frame, array $args)
  {
    // Get options parser.
    $getOption = MW_EXT_Kernel::extractOptions($args, $frame);

    // Argument: name.
    $getName = MW_EXT_Kernel::outClear($getOption['name'] ?? '' ?: '');
    $outName = $getName;

    // Argument: size.
    $getSize = MW_EXT_Kernel::outClear($getOption['size'] ?? '' ?: '');
    $outSize = empty($getSize) ? '' : 'font-size:' . $getOption['size'] . 'em;';

    // Argument: color.
    $getColor = MW_EXT_Kernel::outClear($getOption['color'] ?? '' ?: '');
    $outColor = empty($getColor) ? '' : 'color:' . $getOption['color'] . ';';

    // Argument: options.
    $getCustom = MW_EXT_Kernel::outClear($getOption['options'] ?? '' ?: '');
    $outCustom = $getCustom;

    // Out HTML.
    $outHTML = '<span class="' . $outName . ' ' . $outCustom . ' mw-ext-icon navigation-not-searchable" style="' . $outSize . $outColor . '"></span>';

    // Out parser.
    $outParser = $outHTML;

    return $outParser;
  }

  /**
   * Load resource function.
   *
   * @param OutputPage $out
   * @param Skin $skin
   *
   * @return bool
   */
  public static function onBeforePageDisplay(OutputPage $out, Skin $skin)
  {
    $out->addModuleStyles(['ext.mw.icon.styles']);

    return true;
  }
}
