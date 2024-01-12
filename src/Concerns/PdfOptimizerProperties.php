<?php

namespace Mostafaznv\PdfOptimizer\Concerns;

use Mostafaznv\PdfOptimizer\Attributes\Option;
use Mostafaznv\PdfOptimizer\Enums\AutoRotatePages;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;
use Mostafaznv\PdfOptimizer\Enums\ImageDepth;
use Mostafaznv\PdfOptimizer\Enums\ColorImageDownSampleType;
use Mostafaznv\PdfOptimizer\Enums\ImageFilter;
use Mostafaznv\PdfOptimizer\Enums\CompatibilityLevel;
use Mostafaznv\PdfOptimizer\Enums\DefaultRenderingIntent;
use Mostafaznv\PdfOptimizer\Enums\GrayImageDownSampleType;
use Mostafaznv\PdfOptimizer\Enums\MonoImageDownSampleType;
use Mostafaznv\PdfOptimizer\Enums\MonoImageFilter;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;
use Mostafaznv\PdfOptimizer\Enums\ProcessColorModel;
use Mostafaznv\PdfOptimizer\Enums\UCRandBGInfo;
use Mostafaznv\PdfOptimizer\PdfOptimizer;



trait PdfOptimizerProperties
{
    /**
     * @var string[]
     */
    private array $options = [
        '-sDEVICE=pdfwrite', '-dNOPAUSE', '-dQUIET', '-dBATCH'
    ];

    /**
     * @var string[]
     */
    private array $extraOptions = [];


    #[Option('-dPDFSETTINGS')]
    private PdfSettings $pdfSettings = PdfSettings::SCREEN;

    #[Option('-dFastWebView')]
    private ?bool $fastWebView = null;

    #[Option('-dDetectDuplicateImages')]
    private bool $detectDuplicateImages = true;

    #[Option('-dPreserveMarkedContent')]
    private ?bool $preserveMarkedContent = null;

    #[Option('-dPDFX')]
    private ?bool $pdfX = null;

    #[Option('-dPDFA')]
    private ?int $pdfA = null;

    #[Option('-dPDFACompatibilityPolicy')]
    private ?int $pdfACompatibilityPolicy = null;

    #[Option('-dMaxInlineImageSize')]
    private ?int $maxInlineImageSize = null;

    #[Option('-dEmbedAllFonts')]
    private ?bool $embedAllFonts = null;

    #[Option('-dSubsetFonts')]
    private ?bool $subsetFonts = null;

    #[Option('-dCompressFonts')]
    private ?bool $compressFonts = null;

    #[Option('-dConvertCMYKImagesToRGB')]
    private ?bool $convertCmykImagesToRGB = null;

    #[Option('-dDownsampleColorImages')]
    private ?bool $downSampleColorImages = null;

    #[Option('-dDownsampleGrayImages')]
    private ?bool $downSampleGrayImages = null;

    #[Option('-dDownsampleMonoImages')]
    private ?bool $downSampleMonoImages = null;

    #[Option('-dColorImageResolution')]
    private ?int $colorImageResolution = null;

    #[Option('-dGrayImageResolution')]
    private ?int $grayImageResolution = null;

    #[Option('-dMonoImageResolution')]
    private ?int $monoImageResolution = null;

    #[Option('-dPreserveEPSInfo')]
    private ?bool $preserveEpsInfo = null;

    #[Option('-dPreserveOPIComments')]
    private ?bool $preserveOpiComments = null;

    #[Option('-dASCII85EncodePages')]
    private ?bool $ascii85EncodePages = null;

    #[Option('-dAutoFilterColorImages')]
    private ?bool $autoFilterColorImages = null;

    #[Option('-dAutoFilterGrayImages')]
    private ?bool $autoFilterGrayImages = null;

    #[Option('-dColorImageDownsampleThreshold')]
    private ?float $colorImageDownSampleThreshold = null;

    #[Option('-dGrayImageDownsampleThreshold')]
    private ?float $grayImageDownSampleThreshold = null;

    #[Option('-dMonoImageDownsampleThreshold')]
    private ?float $monoImageDownSampleThreshold = null;

    #[Option('-dCompressPages')]
    private ?bool $compressPages = null;

    #[Option('-dEncodeColorImages')]
    private ?bool $encodeColorImages = null;

    #[Option('-dEncodeGrayImages')]
    private ?bool $encodeGrayImages = null;

    #[Option('-dEncodeMonoImages')]
    private ?bool $encodeMonoImages = null;

    #[Option('-dLockDistillerParams')]
    private ?bool $lockDistillerParams = null;

    #[Option('-dMaxSubsetPct')]
    private ?int $maxSubsetPct = null;

    #[Option('-dParseDSCComments')]
    private ?bool $parseDscComments = null;

    #[Option('-dParseDSCCommentsForDocInfo')]
    private ?bool $parseDscCommentsForDocInfo = null;

    #[Option('-dPreserveHalftoneInfo')]
    private ?bool $preserveHalftoneInfo = null;

    #[Option('-dPreserveOverprintSettings')]
    private ?bool $preserveOverprintSettings = null;

    #[Option('-dUseFlateCompression')]
    private ?bool $useFlateCompression = null;

    #[Option('-dPassThroughJPEGImages')]
    private ?bool $passThroughJpegImages = null;

    #[Option('-dPassThroughJPXImages')]
    private ?bool $passThroughJpxImages = null;

    #[Option('-dCompatibilityLevel')]
    private ?CompatibilityLevel $compatibilityLevel = null;

    #[Option('-sProcessColorModel')]
    private ?ProcessColorModel $processColorModel = null;

    #[Option('-sColorConversionStrategy')]
    private ?ColorConversionStrategy $colorConversionStrategy = null;

    #[Option('-dUCRandBGInfo')]
    private ?UCRandBGInfo $ucRandBbInfo = null;

    #[Option('-dAutoRotatePages')]
    private ?AutoRotatePages $autoRotatePages = null;

    #[Option('-dColorImageDownsampleType')]
    private ?ColorImageDownSampleType $colorImageDownSampleType = null;

    #[Option('-dGrayImageDownsampleType')]
    private ?GrayImageDownSampleType $grayImageDownSampleType = null;

    #[Option('-dMonoImageDownsampleType')]
    private ?MonoImageDownSampleType $monoImageDownSampleType = null;

    #[Option('-dColorImageDepth')]
    private ?ImageDepth $colorImageDepth = null;

    #[Option('-dGrayImageDepth')]
    private ?ImageDepth $grayImageDepth = null;

    #[Option('-dMonoImageDepth')]
    private ?ImageDepth $monoImageDepth = null;

    #[Option('-dColorImageFilter')]
    private ?ImageFilter $colorImageFilter = null;

    #[Option('-dGrayImageFilter')]
    private ?ImageFilter $grayImageFilter = null;

    #[Option('-dMonoImageFilter')]
    private ?MonoImageFilter $monoImageFilter = null;

    #[Option('-dDefaultRenderingIntent')]
    private ?DefaultRenderingIntent $defaultRenderingIntent = null;

    private int $timeout = 300;


    /**
     * #### ASCII85EncodePages
     *
     * If true, Distiller ASCII85-encodes binary streams such as page content streams,
     * sampled images, and embedded fonts, resulting in a PDF file that is pure ASCII.
     * If false, Distiller does not encode the binary streams, resulting in a PDF file
     * that may contain substantial amounts of binary data.
     *
     * Distiller checks the value of this setting only once per document. Any change to
     * it must be made before any marks are placed on the first page of the document.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function ascii85EncodePages(bool $status = true): self
    {
        $this->ascii85EncodePages = $status;

        return $this;
    }

    /**
     * #### AutoFilterColorImages
     *
     * If true, the compression filter for color images is chosen based on the properties of
     * each image, in conjunction with the `ColorImageAutoFilterStrategy` setting.
     * If false, all color sampled images are compressed using the filter specified by ColorImageFilter.
     *
     * This setting is relevant only if EncodeColorImages is true.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function autoFilterColorImages(bool $status = true): self
    {
        $this->autoFilterColorImages = $status;

        return $this;
    }

    /**
     * #### AutoFilterGrayImages
     *
     * If true, the compression filter for gray images is chosen based on the properties of
     * each image, in conjunction with the GrayImageAutoFilterStrategy setting.
     * If false, all color sampled images are compressed using the filter specified by
     * GrayImageFilter.
     *
     * This setting is relevant only if EncodeGrayImages is true.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function autoFilterGrayImages(bool $status = true): self
    {
        $this->autoFilterGrayImages = $status;

        return $this;
    }

    /**
     * #### AutoRotatePages
     *
     * Allows Distiller to automatically orient (rotate) pages based on
     * the predominant text orientation. autorotation is not done if the file contains
     * the %%ViewingOrientation DSC comment and ParseDSCComments is true.
     *
     * If AutoRotatePages is set to None, pages are not automatically oriented and
     * the %%ViewingOrientation DSC comment is ignored.
     *
     * @param AutoRotatePages $mode
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function autoRotatePages(AutoRotatePages $mode): self
    {
        $this->autoRotatePages = $mode;

        return $this;
    }

    /**
     * #### ColorConversionStrategy
     *
     * Sets the color conversion strategy, which includes the output color family and color
     * space and the inclusion of ICC profiles.
     *
     * @param ColorConversionStrategy $strategy
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function colorConversionStrategy(ColorConversionStrategy $strategy): self
    {
        $this->colorConversionStrategy = $strategy;

        return $this;
    }

    /**
     * #### ColorImageDepth
     *
     * Specifies the number of bits per color component in the output image.
     *
     * Allowed values are:
     * The number of bits per sample: 1, 2, 4, or 8.
     * -1 , which forces the downsampled image to have the same number of bits per color
     * component as the original image.
     *
     * @param ImageDepth $depth
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function colorImageDepth(ImageDepth $depth): self
    {
        $this->colorImageDepth = $depth;

        return $this;
    }

    /**
     * #### ColorImageFilter
     *
     * Specifies the compression filter to be used for color images.
     * Ignored if AutoFilterColorImages is true or EncodeColorImages is false.
     *
     * @param ImageFilter $filter
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function colorImageFilter(ImageFilter $filter): self
    {
        $this->colorImageFilter = $filter;

        return $this;
    }

    /**
     * #### ColorImageDownsampleThreshold
     *
     * Sets the downsample threshold for color images.
     * This is the ratio of image resolution to output resolution above which downsampling
     * may be performed. Must be between 1.0 through 10.0, inclusive.
     *
     * If you set the threshold out of range, it reverts to a default of 1.5.
     *
     * @param float $threshold
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function colorImageDownSampleThreshold(float $threshold): self
    {
        $this->colorImageDownSampleThreshold = $threshold;

        return $this;
    }

    /**
     * #### ColorImageDownsampleType
     *
     * Must be one of the following values:
     * - Average (Average Downsampling to):
     * Groups of samples are averaged to get the new downsampled value.
     * - Bicubic (Bicubic Downsampling to):
     * Bicubic interpolation is used on a group of samples to get a new downsampled value.
     * - Subsample (Subsampling to):
     * The center sample from a group of samples is used as the new downsampled value.
     *
     *
     * @param ColorImageDownSampleType $type
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function colorImageDownSampleType(ColorImageDownSampleType $type): self
    {
        $this->colorImageDownSampleType = $type;

        return $this;
    }

    /**
     * #### ColorImageResolution
     *
     * Specifies the resolution to which downsampled color images are reduced;
     * valid values are 9 to 2400 pixels per inch.
     * A color image is downsampled if DownsampleColorImages is true and the resolution of
     * the input image meets the criteria described in Downsampling and subsampling images.
     *
     * @param int $resolution
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function colorImageResolution(int $resolution): self
    {
        $this->colorImageResolution = $resolution;

        return $this;
    }

    /**
     * #### CompatibilityLevel
     *
     * The PDF version number: 1.2, 1.3, 1.4, 1.5, 1.6, or 1.7.
     * Applications other than Distiller do not support saving files as PDF 1.2.
     *
     * @param CompatibilityLevel $compatibilityLevel
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function compatibilityLevel(CompatibilityLevel $compatibilityLevel): self
    {
        $this->compatibilityLevel = $compatibilityLevel;

        return $this;
    }

    /**
     * #### CompressFonts
     *
     * Defines whether pdfwrite will compress embedded fonts in the output.
     * The default value is true; the false setting is intended only for debugging as
     * it will result in larger output.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function compressFonts(bool $status = true): self
    {
        $this->compressFonts = $status;

        return $this;
    }

    /**
     * #### CompressPages
     *
     * If true, Flate compression is used to compress page content streams as
     * well as form, pattern, and Type 3 font content streams.
     * InDesign also compresses ICC profiles, OutputIntentProfile and shading streams.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function compressPages(bool $status = true): self
    {
        $this->compressPages = $status;

        return $this;
    }

    /**
     * #### ConvertCMYKImagesToRGB
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function convertCmykImagesToRGB(bool $status = true): self
    {
        $this->convertCmykImagesToRGB = $status;

        return $this;
    }

    /**
     * #### DefaultRenderingIntent
     *
     * Specifies the rendering intent for objects to be written to the PDF document, when
     * not otherwise specified in the PostScript job by means of the findcolorrendering and
     * setcolorrendering operators.
     *
     * @param DefaultRenderingIntent $renderingIntent
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function defaultRenderingIntent(DefaultRenderingIntent $renderingIntent): self
    {
        $this->defaultRenderingIntent = $renderingIntent;

        return $this;
    }

    /**
     * #### DetectDuplicateImages
     *
     * Takes a Boolean argument, when set to true (the default) pdfwrite will compare all
     * new images with all the images encountered to date (NOT small images which are
     * stored in-line) to see if the new image is a duplicate of an earlier one.
     * If it is a duplicate then instead of writing a new image into the PDF file,
     * the PDF will reuse the reference to the earlier image. This can considerably reduce
     * the size of the output PDF file, but increases the time taken to process the file.
     *
     * This time grows exponentially as more images are added, and on large input files with
     * numerous images can be prohibitively slow. Setting this to false will improve
     * performance at the cost of final file size.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function detectDuplicateImages(bool $status = true): self
    {
        $this->detectDuplicateImages = $status;

        return $this;
    }

    /**
     * #### DownsampleColorImages
     *
     * If true, color images are downsampled using the resolution specified by ColorImageResolution,
     * assuming the threshold specified by ColorImageDownsampleThreshold is met.
     * If false, downsampling is not done and the resolution of color images in the
     * PDF file is the same as the source images.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function downSampleColorImages(bool $status = true): self
    {
        $this->downSampleColorImages = $status;

        return $this;
    }

    /**
     * #### DownsampleGrayImages
     *
     * If true, grayscale images are downsampled using the resolution specified by GrayImageResolution.
     * If false, downsampling does not occur, and the resolution of grayscale images in
     * the PDF file is the same as the source images.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function downSampleGrayImages(bool $status = true): self
    {
        $this->downSampleGrayImages = $status;

        return $this;
    }

    /**
     * #### DownsampleMonoImages
     *
     * If true, monochrome images are downsampled using the resolution specified by MonoImageResolution.
     * If false, downsampling is not done and the resolution of monochrome images in
     * the PDF file is the same as the source images.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function downSampleMonoImages(bool $status = true): self
    {
        $this->downSampleMonoImages = $status;

        return $this;
    }

    /**
     * #### EmbedAllFonts
     *
     * If true, all fonts that have correct permissions are embedded in the PDF file;
     * if false, they are not embedded:
     * - Creative Suite applications automatically embed fonts.
     * - Distiller never embeds fonts in its NeverEmbed list even if this setting is true.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function embedAllFonts(bool $status = true): self
    {
        $this->embedAllFonts = $status;

        return $this;
    }

    /**
     * #### EncodeColorImages
     *
     * If true, color images are encoded using the compression filter specified by the
     * value of ColorImageFilter.
     * If false, compression filters are not applied to color images.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function encodeColorImages(bool $status = true): self
    {
        $this->encodeColorImages = $status;

        return $this;
    }

    /**
     * #### EncodeGrayImages
     *
     * If true, grayscale images are encoded using the compression filter specified by the
     * value of GrayImageFilter.
     * If false, compression filters are not applied to grayscale sampled images.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function encodeGrayImages(bool $status = true): self
    {
        $this->encodeGrayImages = $status;

        return $this;
    }

    /**
     * #### EncodeMonoImages
     *
     * If true, monochrome images are encoded using the compression filter specified by
     * the value of MonoImageFilter.
     * If false, no compression filters are applied to monochrome images.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function encodeMonoImages(bool $status = true): self
    {
        $this->encodeMonoImages = $status;

        return $this;
    }

    /**
     * #### FastWebView
     *
     * Takes a Boolean argument, default is false. When set to true pdfwrite will reorder
     * the output PDF file to conform to the Adobe ‘linearised’ PDF specification.
     * The Acrobat user interface refers to this as ‘Optimised for Fast Web Viewing’.
     *
     * Note that this will cause the conversion to PDF to be slightly slower and will usually
     * result in a slightly larger PDF file. This option is incompatible with producing an
     * encrypted (password protected) PDF file.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function fastWebView(bool $status = true): self
    {
        $this->fastWebView = $status;

        return $this;
    }

    /**
     * #### GrayImageDepth
     *
     * Specifies the number of bits per sample in the image. The following values are valid:
     * - The number of bits per sample: 1 , 2 , 4 , or 8.
     * - -1 , which forces the downsampled image to have the same number of bits per sample as the original image
     *
     * @param ImageDepth $depth
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function grayImageDepth(ImageDepth $depth): self
    {
        $this->grayImageDepth = $depth;

        return $this;
    }

    /**
     * #### GrayImageDownsampleThreshold
     *
     * Sets the image downsample threshold for grayscale images. This is the ratio of image
     * resolution to output resolution above which downsampling may be performed.
     *
     * @param float $threshold
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function grayImageDownSampleThreshold(float $threshold): self
    {
        $this->grayImageDownSampleThreshold = $threshold;

        return $this;
    }

    /**
     * #### GrayImageDownsampleType
     *
     * Must be one of the following values:
     * - Average (Average Downsampling to):
     * Groups of samples are averaged to get the new downsampled value.
     * - Bicubic (Bicubic Downsampling to):
     * Bicubic interpolation is used on a group of samples to get a new downsampled value.
     * - Subsample (Subsampling to):
     * The center sample from a group of samples is used as the new downsampled value.
     *
     * @param GrayImageDownSampleType $type
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function grayImageDownSampleType(GrayImageDownSampleType $type): self
    {
        $this->grayImageDownSampleType = $type;

        return $this;
    }

    /**
     * #### GrayImageFilter
     *
     * Specifies the compression filter to be used for grayscale images.
     * Ignored if AutoFilterGrayImages is true or EncodeGrayImages is false.
     *
     * @param ImageFilter $filter
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function grayImageFilter(ImageFilter $filter): self
    {
        $this->grayImageFilter = $filter;

        return $this;
    }

    /**
     * #### GrayImageResolution
     *
     * Specifies the resolution to which downsampled gray images are reduced.
     * Valid values are 9 to 2400 pixels per inch. A gray image is downsampled if
     * DownsampleGrayImages is true and the resolution of the input image meets the
     * criteria described in Downsampling and subsampling images.
     *
     * @param int $resolution
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function grayImageResolution(int $resolution): self
    {
        $this->grayImageResolution = $resolution;

        return $this;
    }

    /**
     * #### LockDistillerParams
     *
     * If true, Distiller ignores any settings specified by setdistillerparams operators
     * in the incoming PostScript file and uses only those settings present in the
     * Adobe PDF settings file (or their default values if not present).
     *
     * If false, any settings specified in the PostScript file override the initial settings.
     * These settings are in effect for the duration of the current save level.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function lockDistillerParams(bool $status = true): self
    {
        $this->lockDistillerParams = $status;

        return $this;
    }

    /**
     * #### MaxInlineImageSize
     *
     * Specifies the maximum size of an inline image, in bytes. For images larger than this
     * size, pdfwrite will create an XObject instead of embedding the image into the context
     * stream.
     * The default value is 4000.
     *
     * Note that redundant inline images must be embedded each time they occur in the
     * document, while multiple references can be made to a single XObject image.
     * Therefore, it may be advantageous to set a small or zero value if the source document
     * is expected to contain multiple identical images, reducing the size of the generated PDF.
     *
     * @param int $size
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function maxInlineImageSize(int $size): self
    {
        $this->maxInlineImageSize = $size;

        return $this;
    }

    /**
     * #### MaxSubsetPct
     *
     * The maximum percentage of glyphs in a font that can be used before the entire font is
     * embedded instead of a subset.
     * The allowable range is 1 through 100.
     *
     * Distiller only uses this value if SubsetFonts is true. For example, a value of
     * 30 means that a font will be embedded in full (not subset) if more than 30% of
     * glyphs are used; a value of 100 means all fonts will be subset no matter how many
     * glyphs are used (because you cannot use more than 100% of glyphs).
     *
     * @param int $max
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function maxSubsetPct(int $max): self
    {
        $this->maxSubsetPct = $max;

        return $this;
    }

    /**
     * #### MonoImageDepth
     *
     * Specifies the number of bits per sample in a downsampled image. Allowed values are:
     * - The number of bits per sample: 1 , 2 , 4 , or 8.
     * When the value is greater than 1, monochrome images are converted to grayscale images.
     * - -1 , which forces the downsampled image to have the same number of bits per sample
     * as the original image. (For monochrome images, this is the same as a value of 1.)
     *
     * MonoImageDepth is not used unless DownsampleMonoImages and AntiAliasMonoImages are true.
     *
     * @param ImageDepth $depth
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function monoImageDepth(ImageDepth $depth): self
    {
        $this->monoImageDepth = $depth;

        return $this;
    }

    /**
     * #### MonoImageDownsampleThreshold
     *
     * Sets the image downsample threshold for monochrome images. This is the ratio of image
     * resolution to output resolution above which downsampling may be performed.
     *
     * @param float $threshold
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function monoImageDownSampleThreshold(float $threshold): self
    {
        $this->monoImageDownSampleThreshold = $threshold;

        return $this;
    }

    /**
     * #### MonoImageDownsampleType
     *
     * Must be one of the following values:
     * - Average (Average Downsampling to):
     * Groups of samples are averaged to get the new downsampled value.
     * - Bicubic (Bicubic Downsampling to):
     * Bicubic interpolation is used on a group of samples to get a new downsampled value.
     * - Subsample (Subsampling to):
     * The center sample from a group of samples is used as the new downsampled value.
     *
     * @param MonoImageDownSampleType $type
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function monoImageDownSampleType(MonoImageDownSampleType $type): self
    {
        $this->monoImageDownSampleType = $type;

        return $this;
    }

    /**
     * #### MonoImageFilter
     *
     * Specifies the compression filter to be used for monochrome images.
     * Must be one of the following values:
     * - CCITTFaxEncode:
     * Selects CCITT Group 3 or 4 facsimile encoding
     * - FlateEncode:
     * Selects Flate (ZIP) compression
     * - RunLengthEncode:
     * Selects run length encoding
     *
     * @param MonoImageFilter $filter
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function monoImageFilter(MonoImageFilter $filter): self
    {
        $this->monoImageFilter = $filter;

        return $this;
    }

    /**
     * #### MonoImageResolution
     *
     * Specifies the resolution to which downsampled monochrome images are reduced;
     * valid values are 9 to 2400 pixels per inch.
     *
     * A monochrome image is downsampled if DownsampleMonoImages is true and
     * the resolution of the input image meets the criteria
     *
     * @param int $resolution
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function monoImageResolution(int $resolution): self
    {
        $this->monoImageResolution = $resolution;

        return $this;
    }

    /**
     * #### PassThroughJPEGImages
     *
     * If true, JPEG images (images that are already compressed with the DCTEncode filter)
     * are “passed through” Distiller without re-compressing them. (Distiller does perform
     * a decompression to ensure that images are not corrupt, but then passes the
     * original compressed image to the PDF file.) Images that are not compressed will
     * still be compressed according to the image settings in effect for the type of
     * image (for example, ColorImageFilter , etc.).
     *
     * If false, all JPEG encoded images are decompressed and recompressed according the
     * compression settings in effect.
     *
     * Note, however, that JPEG images that meet the following criteria are not passed
     * through even if the value of PassThroughJPEGImages is true:
     * - The image will be downsampled.
     * - ColorConversionStrategy is sRGB and the current PostScript color space (for the image) is not DeviceRGB or DeviceGray.
     * - The image will be cropped—i.e., the clip path is such that more than 10% of the image pixels will be removed.
     *
     * Creative Suite applications do not use this setting. However, Illustrator and
     * InDesign normally behave as if it were true with regard to placed PDF files
     * containing compressed images. That is, they do not normally uncompress and
     * recompress them, unless color conversion or downsampling takes place.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function passThroughJpegImages(bool $status = true): self
    {
        $this->passThroughJpegImages = $status;

        return $this;
    }

    /**
     * #### PassThroughJPXImages
     *
     * When true image data in the source which is encoded using the JPX (JPEG 2000) filter
     * will not be decompressed and then recompressed on output. This prevents the
     * multiplication of JPEG artefacts caused by lossy compression. PassThroughJPXImages
     * currently only affects simple JPX encoded images. It has no effect on JPEG encoded
     * images (see above) or masked images. In addition, this parameter will be ignored if
     * the pdfwrite device needs to modify the source data. This can happen if the image is
     * being downsampled, changing colour space or having transfer functions applied.
     * Note that this parameter essentially overrides the EncodeColorImages and
     * EncodeGrayImages parameters if they are false, the image will still be written with
     * a JPXDecode filter. NB this feature currently only works with PostScript or PDF
     * input, it does not work with PCL, PXL or XPS input.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function passThroughJpxImages(bool $status = true): self
    {
        $this->passThroughJpxImages = $status;

        return $this;
    }

    /**
     * #### ParseDSCComments
     *
     * If true, Distiller parses the DSC comments for any information that might be helpful
     * for distilling the file or for information that is passed into the PDF file.
     * If false, Distiller treats the DSC comments as pure PostScript comments and ignores them.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function parseDscComments(bool $status = true): self
    {
        $this->parseDscComments = $status;

        return $this;
    }

    /**
     * #### ParseDSCCommentsForDocInfo
     *
     * If true, Distiller attempts to preserve the Document Information from the
     * PostScript DSC comments as properties of the PDF document.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function parseDscCommentsForDocInfo(bool $status = true): self
    {
        $this->parseDscCommentsForDocInfo = $status;

        return $this;
    }

    /**
     * #### PDFA
     *
     * Specify the -dPDFA option to specify PDF/A-1, -dPDFA=2 for PDF/A-2 or -dPDFA=3 for PDF/A-3.
     *
     * @param int $version
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function pdfA(int $version): self
    {
        $this->pdfA = $version;

        return $this;
    }

    /**
     * #### PDFACompatibilityPolicy
     *
     * When an operation (e.g. pdfmark) is encountered which cannot be emitted in a
     * PDF/A compliant file, this policy is consulted, there are currently three possible values:
     * - 0 - (default) Include the feature or operation in the output file, the file will not be PDF/A compliant. Because the document Catalog is emitted before this is encountered, the file will still contain PDF/A metadata but will not be compliant. A warning will be emitted in this case.
     * - 1 - The feature or operation is ignored, the resulting PDF file will be PDF/A compliant. A warning will be emitted for every elided feature.
     * - 2 - Processing of the file is aborted with an error, the exact error may vary depending on the nature of the PDF/A incompatibility.
     *
     * @param int $policy
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function pdfACompatibilityPolicy(int $policy): self
    {
        $this->pdfACompatibilityPolicy = $policy;

        return $this;
    }

    /**
     * #### PDFX
     *
     * Specify the -dPDFX option.
     * It provides the document conformity and forces -dCompatibilityLevel=1.3.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function pdfX(bool $status = true): self
    {
        $this->pdfX = $status;

        return $this;
    }

    /**
     * #### PreserveEPSInfo
     *
     * If true, and ParseDSCComments is true, Distiller attempts to preserve the
     * encapsulated PostScript (EPS) information in the PostScript file as properties of
     * the resulting PDF file.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function preserveEpsInfo(bool $status = true): self
    {
        $this->preserveEpsInfo = $status;

        return $this;
    }

    /**
     * #### PreserveHalftoneInfo
     *
     * If true, Distiller passes halftone screen information (frequency, angle, and spot
     * function) into the PDF file.
     * If false, halftone information is not passed in.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function preserveHalftoneInfo(bool $status = true): self
    {
        $this->preserveHalftoneInfo = $status;

        return $this;
    }

    /**
     * #### PreserveMarkedContent
     *
     * We now attempt to preserve marked content from input PDF files through to the output
     * PDF file (note, not in output PostScript!) This does not include marked content relating
     * to optional content, because currently we do not preserve optional content, it is
     * instead applied by the interpreter.
     *
     * This control also requires the PDF interpreter to pass the marked content to the
     * pdfwrite device, this is only done with the new (C-based) PDF interpreter. The
     * old (PostScript-based) interpreter does not support this feature and will not pass
     * marked content to the pdfwrite device.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function preserveMarkedContent(bool $status = true): self
    {
        $this->preserveMarkedContent = $status;

        return $this;
    }

    /**
     * #### PreserveOPIComments
     *
     * If true, Distiller places the page contents within a set of Open Prepress Interface
     * (OPI) comments in a Form XObject dictionary and preserves the OPI comment information
     * in an OPI dictionary attached to the Form. Page contents data within a set of OPI
     * comments may include proxy images, high-resolution images, or nothing.
     *
     * If PreserveOPIComments is false, Distiller ignores OPI comments and their page
     * contents. Setting PreserveOPIComments to false results in slightly simpler and smaller
     * PDF files. Doing so is acceptable when use of an OPI server is not anticipated.
     *
     * Distiller ignores PreserveOPIComments if ParseDSCComments is false.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function preserveOpiComments(bool $status = true): self
    {
        $this->preserveOpiComments = $status;

        return $this;
    }

    /**
     * #### PreserveOverprintSettings
     *
     * If true, Distiller passes the value of the setoverprint operator through to the PDF file.
     * If false, overprint is ignored (the information is not passed).
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function preserveOverprintSettings(bool $status = true): self
    {
        $this->preserveOverprintSettings = $status;

        return $this;
    }

    /**
     * #### ProcessColorModel
     *
     * A symbol taken from /DeviceGray, /DeviceRGB or /DeviceCMYK which can be used to
     * select 1, 3 or 4 colors respectively.
     *
     * Note that this parameter takes precedence over Colors, and that both affect the
     * same variable of the driver.
     *
     * @param ProcessColorModel $model
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function processColorModel(ProcessColorModel $model): self
    {
        $this->processColorModel = $model;

        return $this;
    }

    /**
     * #### PDFSETTINGS
     *
     * Presets the “distiller parameters” to one of the following predefined settings:
     * - /screen selects low-resolution output similar to the Acrobat Distiller (up to version X) “Screen Optimized” setting.
     * - /ebook selects medium-resolution output similar to the Acrobat Distiller (up to version X) “eBook” setting.
     * - /printer selects output similar to the Acrobat Distiller “Print Optimized” (up to version X) setting.
     * - /prepress selects output similar to Acrobat Distiller “Prepress Optimized” (up to version X) setting.
     * - /default selects output intended to be useful across a wide variety of uses, possibly at the expense of a larger output file.
     *
     * Please be aware that the /prepress setting does not indicate the highest quality
     * conversion. Using any of these presets will involve altering the input, and as
     * such may result in a PDF of poorer quality (compared to the input) than simply using
     * the defaults. The ‘best’ quality (where best means closest to the original
     * input) is obtained by not setting this parameter at all (or by using /default).
     *
     * The PDFSETTINGS presets should only be used if you are sure you understand that
     * the output will be altered in a variety of ways from the input. It is usually
     * better to adjust the controls individually if you have a genuine requirement to
     * produce, for example, a PDF file where the images are reduced in resolution.
     *
     * @param PdfSettings $settings
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function settings(PdfSettings $settings): self
    {
        $this->pdfSettings = $settings;

        return $this;
    }

    /**
     * #### SubsetFonts
     *
     * If true, font subsetting is enabled.
     * If false, subsetting is not enabled. Font subsetting embeds only those glyphs that
     * are used in a document, instead of the entire font. This reduces the size of a
     * PDF file that contains embedded fonts. If font subsetting is enabled, the application
     * determines whether to embed the entire font or a subset by the number of glyphs in
     * the font that are used (including component glyphs referenced by ‘seac’ [Type 1]
     * glyphs), and the value of MaxSubsetPct.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function subsetFonts(bool $status = true): self
    {
        $this->subsetFonts = $status;

        return $this;
    }

    /**
     * #### UCRandBGInfo
     *
     * @param UCRandBGInfo $info
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function ucRandBbInfo(UCRandBGInfo $info): self
    {
        $this->ucRandBbInfo = $info;

        return $this;
    }

    /**
     * #### UseFlateCompression
     *
     * Because the LZW compression scheme was covered by patents at the time this device
     * was created, pdfwrite does not actually use LZW compression: all requests for LZW
     * compression are ignored. UseFlateCompression is treated as always on, but the
     * switch CompressPages can be set too false to turn off page level stream compression.
     * Now that the patent has expired, we could change this should it become worthwhile.
     *
     * @param bool $status
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function useFlateCompression(bool $status = true): self
    {
        $this->useFlateCompression = $status;

        return $this;
    }

    /**
     * @param string[] $options
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function setExtraOptions(array $options): self
    {
        $this->extraOptions = $options;

        return  $this;
    }

    /**
     * Set timeout in seconds
     *
     * @param int $seconds
     * @return PdfOptimizerProperties|PdfOptimizer
     */
    public function setTimeout(int $seconds): self
    {
        $this->timeout = $seconds;

        return $this;
    }
}
