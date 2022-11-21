<?php

namespace GarrettMassey\Analytics\Parameters;

use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\Dimension;
use Illuminate\Support\Collection;

class Dimensions
{

    private Collection $dimensions;

    public function __construct()
    {
        $this->dimensions = collect();
    }

    public function getDimensions(): Collection
    {
        return $this->dimensions;
    }

    public function achievementId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'achievementId']));
        return $this;
    }

    public function adFormat(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'adFormat']));
        return $this;
    }

    public function adSourceName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'adSourceName']));
        return $this;
    }

    public function adUnitName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'adUnitName']));
        return $this;
    }

    public function appVersion(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'appVersion']));
        return $this;
    }

    public function audienceId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'audienceId']));
        return $this;
    }

    public function audienceName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'audienceName']));
        return $this;
    }

    public function brandingInterest(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'brandingInterest']));
        return $this;
    }

    public function browser(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'browser']));
        return $this;
    }

    public function campaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'campaignId']));
        return $this;
    }

    public function campaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'campaignName']));
        return $this;
    }

    public function character(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'character']));
        return $this;
    }

    public function city(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'city']));
        return $this;
    }

    public function cityId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'cityId']));
        return $this;
    }

    public function cohort(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'cohort']));
        return $this;
    }

    public function cohortNthDay(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'cohortNthDay']));
        return $this;
    }

    public function cohortNthMonth(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'cohortNthMonth']));
        return $this;
    }

    public function cohortNthWeek(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'cohortNthWeek']));
        return $this;
    }

    public function contentGroup(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'contentGroup']));
        return $this;
    }

    public function contentId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'contentId']));
        return $this;
    }

    public function contentType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'contentType']));
        return $this;
    }

    public function country(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'country']));
        return $this;
    }

    public function countryId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'countryId']));
        return $this;
    }

    public function date(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'date']));
        return $this;
    }

    public function dateHour(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'dateHour']));
        return $this;
    }

    public function dateHourMinute(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'dateHourMinute']));
        return $this;
    }

    public function day(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'day']));
        return $this;
    }

    public function dayOfWeek(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'dayOfWeek']));
        return $this;
    }

    public function defaultChannelGroup(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'defaultChannelGroup']));
        return $this;
    }

    public function deviceCategory(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'deviceCategory']));
        return $this;
    }

    public function deviceModel(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'deviceModel']));
        return $this;
    }

    public function eventName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'eventName']));
        return $this;
    }

    public function fileExtension(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'fileExtension']));
        return $this;
    }

    public function fileName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'fileName']));
        return $this;
    }

    public function firstSessionDate(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstSessionDate']));
        return $this;
    }

    public function firstUserCampaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserCampaignId']));
        return $this;
    }

    public function firstUserCampaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserCampaignName']));
        return $this;
    }

    public function firstUserDefaultChannelGroup(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserDefaultChannelGroup']));
        return $this;
    }

    public function firstUserGoogleAdsAccountName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsAccountName']));
        return $this;
    }

    public function firstUserGoogleAdsAdGroupId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsAdGroupId']));
        return $this;
    }

    public function firstUserGoogleAdsAdGroupName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsAdGroupName']));
        return $this;
    }

    public function firstUserGoogleAdsAdNetworkType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsAdNetworkType']));
        return $this;
    }

    public function firstUserGoogleAdsCampaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsCampaignId']));
        return $this;
    }

    public function firstUserGoogleAdsCampaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsCampaignName']));
        return $this;
    }

    public function firstUserGoogleAdsCampaignType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsCampaignType']));
        return $this;
    }

    public function firstUserGoogleAdsCreativeId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsCreativeId']));
        return $this;
    }

    public function firstUserGoogleAdsCustomerId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsCustomerId']));
        return $this;
    }

    public function firstUserGoogleAdsKeyword(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsKeyword']));
        return $this;
    }

    public function firstUserGoogleAdsQuery(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserGoogleAdsQuery']));
        return $this;
    }

    public function firstUserManualAdContent(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserManualAdContent']));
        return $this;
    }

    public function firstUserManualTerm(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserManualTerm']));
        return $this;
    }

    public function firstUserMedium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserMedium']));
        return $this;
    }

    public function firstUserSource(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserSource']));
        return $this;
    }

    public function firstUserSourceMedium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserSourceMedium']));
        return $this;
    }

    public function firstUserSourcePlatform(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'firstUserSourcePlatform']));
        return $this;
    }

    public function fullPageUrl(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'fullPageUrl']));
        return $this;
    }

    public function googleAdsAccountName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsAccountName']));
        return $this;
    }

    public function googleAdsAdGroupId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsAdGroupId']));
        return $this;
    }

    public function googleAdsAdGroupName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsAdGroupName']));
        return $this;
    }

    public function googleAdsAdNetworkType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsAdNetworkType']));
        return $this;
    }

    public function googleAdsCampaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsCampaignId']));
        return $this;
    }

    public function googleAdsCampaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsCampaignName']));
        return $this;
    }

    public function googleAdsCampaignType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsCampaignType']));
        return $this;
    }

    public function googleAdsCreativeId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsCreativeId']));
        return $this;
    }

    public function googleAdsCustomerId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsCustomerId']));
        return $this;
    }

    public function googleAdsKeyword(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsKeyword']));
        return $this;
    }

    public function googleAdsQuery(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'googleAdsQuery']));
        return $this;
    }

    public function groupId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'groupId']));
        return $this;
    }

    public function hostName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'hostName']));
        return $this;
    }

    public function hour(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'hour']));
        return $this;
    }

    public function isConversionEvent(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'isConversionEvent']));
        return $this;
    }

    public function itemAffiliation(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemAffiliation']));
        return $this;
    }

    public function itemBrand(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemBrand']));
        return $this;
    }

    public function itemCategory(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemCategory']));
        return $this;
    }

    public function itemCategory2(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemCategory2']));
        return $this;
    }

    public function itemCategory3(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemCategory3']));
        return $this;
    }

    public function itemCategory4(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemCategory4']));
        return $this;
    }

    public function itemCategory5(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemCategory5']));
        return $this;
    }

    public function itemId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemId']));
        return $this;
    }

    public function itemListId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemListId']));
        return $this;
    }

    public function itemListName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemListName']));
        return $this;
    }

    public function itemName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemName']));
        return $this;
    }

    public function itemPromotionCreativeName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemPromotionCreativeName']));
        return $this;
    }

    public function itemPromotionId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemPromotionId']));
        return $this;
    }

    public function itemPromotionName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemPromotionName']));
        return $this;
    }

    public function itemVariant(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'itemVariant']));
        return $this;
    }

    public function landingPage(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'landingPage']));
        return $this;
    }

    public function language(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'language']));
        return $this;
    }

    public function languageCode(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'languageCode']));
        return $this;
    }

    public function level(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'level']));
        return $this;
    }

    public function linkClasses(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'linkClasses']));
        return $this;
    }

    public function linkDomain(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'linkDomain']));
        return $this;
    }

    public function linkId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'linkId']));
        return $this;
    }

    public function linkText(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'linkText']));
        return $this;
    }

    public function linkUrl(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'linkUrl']));
        return $this;
    }

    public function manualAdContent(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'manualAdContent']));
        return $this;
    }

    public function manualTerm(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'manualTerm']));
        return $this;
    }

    public function medium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'medium']));
        return $this;
    }

    public function method(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'method']));
        return $this;
    }

    public function minute(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'minute']));
        return $this;
    }

    public function mobileDeviceBranding(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'mobileDeviceBranding']));
        return $this;
    }

    public function mobileDeviceMarketingName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'mobileDeviceMarketingName']));
        return $this;
    }

    public function mobileDeviceModel(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'mobileDeviceModel']));
        return $this;
    }

    public function month(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'month']));
        return $this;
    }

    public function newVsReturning(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'newVsReturning']));
        return $this;
    }

    public function nthDay(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'nthDay']));
        return $this;
    }

    public function nthHour(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'nthHour']));
        return $this;
    }

    public function nthMinute(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'nthMinute']));
        return $this;
    }

    public function nthMonth(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'nthMonth']));
        return $this;
    }

    public function nthWeek(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'nthWeek']));
        return $this;
    }

    public function nthYear(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'nthYear']));
        return $this;
    }

    public function operatingSystem(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'operatingSystem']));
        return $this;
    }

    public function operatingSystemVersion(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'operatingSystemVersion']));
        return $this;
    }

    public function operatingSystemWithVersion(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'operatingSystemWithVersion']));
        return $this;
    }

    public function orderCoupon(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'orderCoupon']));
        return $this;
    }

    public function outbound(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'outbound']));
        return $this;
    }

    public function pageLocation(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'pageLocation']));
        return $this;
    }

    public function pagePath(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'pagePath']));
        return $this;
    }

    public function pagePathPlusQueryString(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'pagePathPlusQueryString']));
        return $this;
    }

    public function pageReferrer(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'pageReferrer']));
        return $this;
    }

    public function pageTitle(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'pageTitle']));
        return $this;
    }

    public function percentScrolled(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'percentScrolled']));
        return $this;
    }

    public function platform(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'platform']));
        return $this;
    }

    public function platformDeviceCategory(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'platformDeviceCategory']));
        return $this;
    }

    public function region(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'region']));
        return $this;
    }

    public function screenResolution(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'screenResolution']));
        return $this;
    }

    public function searchTerm(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'searchTerm']));
        return $this;
    }

    public function sessionCampaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionCampaignId']));
        return $this;
    }

    public function sessionCampaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionCampaignName']));
        return $this;
    }

    public function sessionDefaultChannelGroup(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionDefaultChannelGroup']));
        return $this;
    }

    public function sessionGoogleAdsAccountName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsAccountName']));
        return $this;
    }

    public function sessionGoogleAdsAdGroupId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsAdGroupId']));
        return $this;
    }

    public function sessionGoogleAdsAdGroupName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsAdGroupName']));
        return $this;
    }

    public function sessionGoogleAdsAdNetworkType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsAdNetworkType']));
        return $this;
    }

    public function sessionGoogleAdsCampaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsCampaignId']));
        return $this;
    }

    public function sessionGoogleAdsCampaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsCampaignName']));
        return $this;
    }

    public function sessionGoogleAdsCampaignType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsCampaignType']));
        return $this;
    }

    public function sessionGoogleAdsCreativeId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsCreativeId']));
        return $this;
    }

    public function sessionGoogleAdsCustomerId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsCustomerId']));
        return $this;
    }

    public function sessionGoogleAdsKeyword(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsKeyword']));
        return $this;
    }

    public function sessionGoogleAdsQuery(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionGoogleAdsQuery']));
        return $this;
    }

    public function sessionManualAdContent(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionManualAdContent']));
        return $this;
    }

    public function sessionManualTerm(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionManualTerm']));
        return $this;
    }

    public function sessionMedium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionMedium']));
        return $this;
    }

    public function sessionSa360AdGroupName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360AdGroupName']));
        return $this;
    }

    public function sessionSa360CampaignId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360CampaignId']));
        return $this;
    }

    public function sessionSa360CampaignName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360CampaignName']));
        return $this;
    }

    public function sessionSa360CreativeFormat(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360CreativeFormat']));
        return $this;
    }

    public function sessionSa360EngineAccountId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360EngineAccountId']));
        return $this;
    }

    public function sessionSa360EngineAccountName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360EngineAccountName']));
        return $this;
    }

    public function sessionSa360EngineAccountType(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360EngineAccountType']));
        return $this;
    }

    public function sessionSa360Keyword(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360Keyword']));
        return $this;
    }

    public function sessionSa360Medium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360Medium']));
        return $this;
    }

    public function sessionSa360Query(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360Query']));
        return $this;
    }

    public function sessionSa360Source(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSa360Source']));
        return $this;
    }

    public function sessionSource(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSource']));
        return $this;
    }

    public function sessionSourceMedium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSourceMedium']));
        return $this;
    }

    public function sessionSourcePlatform(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sessionSourcePlatform']));
        return $this;
    }

    public function shippingTier(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'shippingTier']));
        return $this;
    }

    public function signedInWithUserId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'signedInWithUserId']));
        return $this;
    }

    public function source(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'source']));
        return $this;
    }

    public function sourceMedium(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sourceMedium']));
        return $this;
    }

    public function sourcePlatform(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'sourcePlatform']));
        return $this;
    }

    public function streamId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'streamId']));
        return $this;
    }

    public function streamName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'streamName']));
        return $this;
    }

    public function testDataFilterName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'testDataFilterName']));
        return $this;
    }

    public function transactionId(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'transactionId']));
        return $this;
    }

    public function unifiedPagePathScreen(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'unifiedPagePathScreen']));
        return $this;
    }

    public function unifiedPageScreen(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'unifiedPageScreen']));
        return $this;
    }

    public function unifiedScreenClass(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'unifiedScreenClass']));
        return $this;
    }

    public function unifiedScreenName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'unifiedScreenName']));
        return $this;
    }

    public function userAgeBracket(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'userAgeBracket']));
        return $this;
    }

    public function userGender(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'userGender']));
        return $this;
    }

    public function videoProvider(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'videoProvider']));
        return $this;
    }

    public function videoTitle(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'videoTitle']));
        return $this;
    }

    public function videoUrl(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'videoUrl']));
        return $this;
    }

    public function virtualCurrencyName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'virtualCurrencyName']));
        return $this;
    }

    public function visible(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'visible']));
        return $this;
    }

    public function week(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'week']));
        return $this;
    }

    public function year(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'year']));
        return $this;
    }

}
