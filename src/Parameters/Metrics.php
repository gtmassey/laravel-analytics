<?php

namespace GarrettMassey\Analytics\Parameters;

use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\Metric;
use Illuminate\Support\Collection;

class Metrics
{
    private Collection $metrics;

    public function __construct()
    {
        $this->metrics = collect();
    }

    public function getMetrics(): Collection
    {
        return $this->metrics;
    }

    public function active1DayUsers() {
        $this->metrics->push(new Metric(['name' => 'active1DayUsers']));
        return $this;
    }

    public function active28DayUsers() {
        $this->metrics->push(new Metric(['name' => 'active28DayUsers']));
        return $this;
    }

    public function active7DayUsers() {
        $this->metrics->push(new Metric(['name' => 'active7DayUsers']));
        return $this;
    }

    public function activeUsers() {
        $this->metrics->push(new Metric(['name' => 'activeUsers']));
        return $this;
    }

    public function adUnitExposure() {
        $this->metrics->push(new Metric(['name' => 'adUnitExposure']));
        return $this;
    }

    public function addToCarts() {
        $this->metrics->push(new Metric(['name' => 'addToCarts']));
        return $this;
    }

    public function advertiserAdClicks() {
        $this->metrics->push(new Metric(['name' => 'advertiserAdClicks']));
        return $this;
    }

    public function advertiserAdCost() {
        $this->metrics->push(new Metric(['name' => 'advertiserAdCost']));
        return $this;
    }

    public function advertiserAdCostPerClick() {
        $this->metrics->push(new Metric(['name' => 'advertiserAdCostPerClick']));
        return $this;
    }

    public function advertiserAdCostPerConversion() {
        $this->metrics->push(new Metric(['name' => 'advertiserAdCostPerConversion']));
        return $this;
    }

    public function advertiserAdImpressions() {
        $this->metrics->push(new Metric(['name' => 'advertiserAdImpressions']));
        return $this;
    }

    public function averagePurchaseRevenue() {
        $this->metrics->push(new Metric(['name' => 'averagePurchaseRevenue']));
        return $this;
    }

    public function averagePurchaseRevenuePerPayingUser() {
        $this->metrics->push(new Metric(['name' => 'averagePurchaseRevenuePerPayingUser']));
        return $this;
    }

    public function averagePurchaseRevenuePerUser() {
        $this->metrics->push(new Metric(['name' => 'averagePurchaseRevenuePerUser']));
        return $this;
    }

    public function averageRevenuePerUser() {
        $this->metrics->push(new Metric(['name' => 'averageRevenuePerUser']));
        return $this;
    }

    public function averageSessionDuration() {
        $this->metrics->push(new Metric(['name' => 'averageSessionDuration']));
        return $this;
    }

    public function bounceRate() {
        $this->metrics->push(new Metric(['name' => 'bounceRate']));
        return $this;
    }

    public function cartToViewRate() {
        $this->metrics->push(new Metric(['name' => 'cartToViewRate']));
        return $this;
    }

    public function checkouts() {
        $this->metrics->push(new Metric(['name' => 'checkouts']));
        return $this;
    }

    public function cohortActiveUsers() {
        $this->metrics->push(new Metric(['name' => 'cohortActiveUsers']));
        return $this;
    }

    public function cohortTotalUsers() {
        $this->metrics->push(new Metric(['name' => 'cohortTotalUsers']));
        return $this;
    }

    public function conversions() {
        $this->metrics->push(new Metric(['name' => 'conversions']));
        return $this;
    }

    public function crashAffectedUsers() {
        $this->metrics->push(new Metric(['name' => 'crashAffectedUsers']));
        return $this;
    }

    public function crashFreeUsersRate() {
        $this->metrics->push(new Metric(['name' => 'crashFreeUsersRate']));
        return $this;
    }

    public function dauPerMau() {
        $this->metrics->push(new Metric(['name' => 'dauPerMau']));
        return $this;
    }

    public function dauPerWau() {
        $this->metrics->push(new Metric(['name' => 'dauPerWau']));
        return $this;
    }

    public function ecommercePurchases() {
        $this->metrics->push(new Metric(['name' => 'ecommercePurchases']));
        return $this;
    }

    public function engagedSessions() {
        $this->metrics->push(new Metric(['name' => 'engagedSessions']));
        return $this;
    }

    public function engagementRate() {
        $this->metrics->push(new Metric(['name' => 'engagementRate']));
        return $this;
    }

    public function eventCount() {
        $this->metrics->push(new Metric(['name' => 'eventCount']));
        return $this;
    }

    public function eventCountPerUser() {
        $this->metrics->push(new Metric(['name' => 'eventCountPerUser']));
        return $this;
    }

    public function eventValue() {
        $this->metrics->push(new Metric(['name' => 'eventValue']));
        return $this;
    }

    public function eventsPerSession() {
        $this->metrics->push(new Metric(['name' => 'eventsPerSession']));
        return $this;
    }

    public function firstTimePurchaserConversionRate() {
        $this->metrics->push(new Metric(['name' => 'firstTimePurchaserConversionRate']));
        return $this;
    }

    public function firstTimePurchasers() {
        $this->metrics->push(new Metric(['name' => 'firstTimePurchasers']));
        return $this;
    }

    public function firstTimePurchasersPerNewUser() {
        $this->metrics->push(new Metric(['name' => 'firstTimePurchasersPerNewUser']));
        return $this;
    }

    public function itemListClickEvents() {
        $this->metrics->push(new Metric(['name' => 'itemListClickEvents']));
        return $this;
    }

    public function itemListClickThroughRate() {
        $this->metrics->push(new Metric(['name' => 'itemListClickThroughRate']));
        return $this;
    }

    public function itemListViewEvents() {
        $this->metrics->push(new Metric(['name' => 'itemListViewEvents']));
        return $this;
    }

    public function itemPromotionClickThroughRate() {
        $this->metrics->push(new Metric(['name' => 'itemPromotionClickThroughRate']));
        return $this;
    }

    public function itemRevenue() {
        $this->metrics->push(new Metric(['name' => 'itemRevenue']));
        return $this;
    }

    public function itemViewEvents() {
        $this->metrics->push(new Metric(['name' => 'itemViewEvents']));
        return $this;
    }

    public function itemsAddedToCart() {
        $this->metrics->push(new Metric(['name' => 'itemsAddedToCart']));
        return $this;
    }

    public function itemsCheckedOut() {
        $this->metrics->push(new Metric(['name' => 'itemsCheckedOut']));
        return $this;
    }

    public function itemsClickedInList() {
        $this->metrics->push(new Metric(['name' => 'itemsClickedInList']));
        return $this;
    }

    public function itemsClickedInPromotion() {
        $this->metrics->push(new Metric(['name' => 'itemsClickedInPromotion']));
        return $this;
    }

    public function itemsPurchased() {
        $this->metrics->push(new Metric(['name' => 'itemsPurchased']));
        return $this;
    }

    public function itemsViewed() {
        $this->metrics->push(new Metric(['name' => 'itemsViewed']));
        return $this;
    }

    public function itemsViewedInList() {
        $this->metrics->push(new Metric(['name' => 'itemsViewedInList']));
        return $this;
    }

    public function itemsViewedInPromotion() {
        $this->metrics->push(new Metric(['name' => 'itemsViewedInPromotion']));
        return $this;
    }

    public function newUsers() {
        $this->metrics->push(new Metric(['name' => 'newUsers']));
        return $this;
    }

    public function organicGoogleSearchAveragePosition() {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchAveragePosition']));
        return $this;
    }

    public function organicGoogleSearchClickThroughRate() {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchClickThroughRate']));
        return $this;
    }

    public function organicGoogleSearchClicks() {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchClicks']));
        return $this;
    }

    public function organicGoogleSearchImpressions() {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchImpressions']));
        return $this;
    }

    public function promotionClicks() {
        $this->metrics->push(new Metric(['name' => 'promotionClicks']));
        return $this;
    }

    public function promotionViews() {
        $this->metrics->push(new Metric(['name' => 'promotionViews']));
        return $this;
    }

    public function publisherAdClicks() {
        $this->metrics->push(new Metric(['name' => 'publisherAdClicks']));
        return $this;
    }

    public function publisherAdImpressions() {
        $this->metrics->push(new Metric(['name' => 'publisherAdImpressions']));
        return $this;
    }

    public function purchaseRevenue() {
        $this->metrics->push(new Metric(['name' => 'purchaseRevenue']));
        return $this;
    }

    public function purchaseToViewRate() {
        $this->metrics->push(new Metric(['name' => 'purchaseToViewRate']));
        return $this;
    }

    public function purchaserConversionRate() {
        $this->metrics->push(new Metric(['name' => 'purchaserConversionRate']));
        return $this;
    }

    public function returnOnAdSpend() {
        $this->metrics->push(new Metric(['name' => 'returnOnAdSpend']));
        return $this;
    }

    public function screenPageViews() {
        $this->metrics->push(new Metric(['name' => 'screenPageViews']));
        return $this;
    }

    public function screenPageViewsPerSession() {
        $this->metrics->push(new Metric(['name' => 'screenPageViewsPerSession']));
        return $this;
    }

    public function sessionConversionRate() {
        $this->metrics->push(new Metric(['name' => 'sessionConversionRate']));
        return $this;
    }

    public function sessions() {
        $this->metrics->push(new Metric(['name' => 'sessions']));
        return $this;
    }

    public function sessionsPerUser() {
        $this->metrics->push(new Metric(['name' => 'sessionsPerUser']));
        return $this;
    }

    public function shippingAmount() {
        $this->metrics->push(new Metric(['name' => 'shippingAmount']));
        return $this;
    }

    public function taxAmount() {
        $this->metrics->push(new Metric(['name' => 'taxAmount']));
        return $this;
    }

    public function totalAdRevenue() {
        $this->metrics->push(new Metric(['name' => 'totalAdRevenue']));
        return $this;
    }

    public function totalPurchasers() {
        $this->metrics->push(new Metric(['name' => 'totalPurchasers']));
        return $this;
    }

    public function totalRevenue() {
        $this->metrics->push(new Metric(['name' => 'totalRevenue']));
        return $this;
    }

    public function totalUsers() {
        $this->metrics->push(new Metric(['name' => 'totalUsers']));
        return $this;
    }

    public function transactions() {
        $this->metrics->push(new Metric(['name' => 'transactions']));
        return $this;
    }

    public function transactionsPerPurchaser() {
        $this->metrics->push(new Metric(['name' => 'transactionsPerPurchaser']));
        return $this;
    }

    public function userConversionRate() {
        $this->metrics->push(new Metric(['name' => 'userConversionRate']));
        return $this;
    }

    public function userEngagementDuration() {
        $this->metrics->push(new Metric(['name' => 'userEngagementDuration']));
        return $this;
    }

    public function wauPerMau() {
        $this->metrics->push(new Metric(['name' => 'wauPerMau']));
        return $this;
    }

}
