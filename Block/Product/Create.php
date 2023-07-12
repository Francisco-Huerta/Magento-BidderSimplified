<?php
namespace Bidder\CustomSellerOptions\Block\Product;

use Webkul\Marketplace\Block\Product\Create as OriginalCreate;
use Magento\Catalog\Block\Product\Context as ProductContext;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Category;
use Magento\GoogleOptimizer\Model\Code as ModelCode;
use Webkul\Marketplace\Helper\Data as HelperData;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\DB\Helper as FrameworkDbHelper;
use Magento\Catalog\Helper\Category as CategoryHelper;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Cms\Helper\Wysiwyg\Images as WysiwygImages;
use Magento\Framework\App\CacheInterface;
use Magento\Directory\Model\Currency;
use Magento\Eav\Model\Config;

class Create extends OriginalCreate
{
    /**
     * @var Config
     */
    protected $eavConfig;

    /**
     * @param ProductContext $context
     * @param Product $product
     * @param Category $category
     * @param ModelCode $modelCode
     * @param HelperData $helperData
     * @param ProductRepositoryInterface $productRepository
     * @param CollectionFactory $categoryCollectionFactory
     * @param FrameworkDbHelper $frameworkDbHelper
     * @param CategoryHelper $categoryHelper
     * @param DataPersistorInterface $dataPersistor
     * @param SerializerInterface $serializer
     * @param WysiwygImages $wysiwygImages
     * @param CacheInterface $cacheInterface
     * @param Currency $currency
     * @param Config $eavConfig
     * @param array $data
     */
    public function __construct(
        ProductContext $context,
        Product $product,
        Category $category,
        ModelCode $modelCode,
        HelperData $helperData,
        ProductRepositoryInterface $productRepository,
        CollectionFactory $categoryCollectionFactory,
        FrameworkDbHelper $frameworkDbHelper,
        CategoryHelper $categoryHelper,
        DataPersistorInterface $dataPersistor,
        SerializerInterface $serializer,
        WysiwygImages $wysiwygImages,
        CacheInterface $cacheInterface,
        Currency $currency,
        Config $eavConfig,
        array $data = []
    ) {
        $this->eavConfig = $eavConfig;
        parent::__construct(
            $context,
            $product,
            $category,
            $modelCode,
            $helperData,
            $productRepository,
            $categoryCollectionFactory,
            $frameworkDbHelper,
            $categoryHelper,
            $dataPersistor,
            $serializer,
            $wysiwygImages,
            $cacheInterface,
            $currency,
            $data
        );
    }

    /**
     * Get all options of an attribute by attribute code
     *
     * @param string $attributeCode
     * @return array
     */
    public function getAttributeOptions($attributeCode)
    {
        $attribute = $this->eavConfig->getAttribute('catalog_product', $attributeCode);
        $options = $attribute->getSource()->getAllOptions();

        return $options;
    }
}


