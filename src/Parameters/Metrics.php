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

    public function active1DayUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'active1DayUsers']));
        return $this;
    }

    public function active28DayUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'active28DayUsers']));
        return $this;
    }

    public function active7DayUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'active7DayUsers']));
        return $this;
    }

    public function activeUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'activeUsers']));
        return $this;
    }

    public function adUnitExposure(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'adUnitExposure']));
        return $this;
    }

    public function addToCarts(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'addToCarts']));
        return $this;
    }

    public function advertiserAdClicks(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'advertiserAdClicks']));
        return $this;
    }

    public function advertiserAdCost(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'advertiserAdCost']));
        return $this;
    }

    public function advertiserAdCostPerClick(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'advertiserAdCostPerClick']));
        return $this;
    }

    public function advertiserAdCostPerConversion(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'advertiserAdCostPerConversion']));
        return $this;
    }

    public function advertiserAdImpressions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'advertiserAdImpressions']));
        return $this;
    }

    public function averagePurchaseRevenue(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'averagePurchaseRevenue']));
        return $this;
    }

    public function averagePurchaseRevenuePerPayingUser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'averagePurchaseRevenuePerPayingUser']));
        return $this;
    }

    public function averagePurchaseRevenuePerUser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'averagePurchaseRevenuePerUser']));
        return $this;
    }

    public function averageRevenuePerUser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'averageRevenuePerUser']));
        return $this;
    }

    public function averageSessionDuration(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'averageSessionDuration']));
        return $this;
    }

    public function bounceRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'bounceRate']));
        return $this;
    }

    public function cartToViewRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'cartToViewRate']));
        return $this;
    }

    public function checkouts(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'checkouts']));
        return $this;
    }

    public function cohortActiveUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'cohortActiveUsers']));
        return $this;
    }

    public function cohortTotalUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'cohortTotalUsers']));
        return $this;
    }

    public function conversions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'conversions']));
        return $this;
    }

    public function crashAffectedUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'crashAffectedUsers']));
        return $this;
    }

    public function crashFreeUsersRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'crashFreeUsersRate']));
        return $this;
    }

    public function dauPerMau(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'dauPerMau']));
        return $this;
    }

    public function dauPerWau(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'dauPerWau']));
        return $this;
    }

    public function ecommercePurchases(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'ecommercePurchases']));
        return $this;
    }

    public function engagedSessions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'engagedSessions']));
        return $this;
    }

    public function engagementRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'engagementRate']));
        return $this;
    }

    public function eventCount(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'eventCount']));
        return $this;
    }

    public function eventCountPerUser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'eventCountPerUser']));
        return $this;
    }

    public function eventValue(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'eventValue']));
        return $this;
    }

    public function eventsPerSession(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'eventsPerSession']));
        return $this;
    }

    public function firstTimePurchaserConversionRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'firstTimePurchaserConversionRate']));
        return $this;
    }

    public function firstTimePurchasers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'firstTimePurchasers']));
        return $this;
    }

    public function firstTimePurchasersPerNewUser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'firstTimePurchasersPerNewUser']));
        return $this;
    }

    public function itemListClickEvents(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemListClickEvents']));
        return $this;
    }

    public function itemListClickThroughRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemListClickThroughRate']));
        return $this;
    }

    public function itemListViewEvents(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemListViewEvents']));
        return $this;
    }

    public function itemPromotionClickThroughRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemPromotionClickThroughRate']));
        return $this;
    }

    public function itemRevenue(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemRevenue']));
        return $this;
    }

    public function itemViewEvents(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemViewEvents']));
        return $this;
    }

    public function itemsAddedToCart(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsAddedToCart']));
        return $this;
    }

    public function itemsCheckedOut(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsCheckedOut']));
        return $this;
    }

    public function itemsClickedInList(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsClickedInList']));
        return $this;
    }

    public function itemsClickedInPromotion(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsClickedInPromotion']));
        return $this;
    }

    public function itemsPurchased(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsPurchased']));
        return $this;
    }

    public function itemsViewed(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsViewed']));
        return $this;
    }

    public function itemsViewedInList(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsViewedInList']));
        return $this;
    }

    public function itemsViewedInPromotion(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'itemsViewedInPromotion']));
        return $this;
    }

    public function newUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'newUsers']));
        return $this;
    }

    public function organicGoogleSearchAveragePosition(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchAveragePosition']));
        return $this;
    }

    public function organicGoogleSearchClickThroughRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchClickThroughRate']));
        return $this;
    }

    public function organicGoogleSearchClicks(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchClicks']));
        return $this;
    }

    public function organicGoogleSearchImpressions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchImpressions']));
        return $this;
    }

    public function promotionClicks(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'promotionClicks']));
        return $this;
    }

    public function promotionViews(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'promotionViews']));
        return $this;
    }

    public function publisherAdClicks(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'publisherAdClicks']));
        return $this;
    }

    public function publisherAdImpressions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'publisherAdImpressions']));
        return $this;
    }

    public function purchaseRevenue(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'purchaseRevenue']));
        return $this;
    }

    public function purchaseToViewRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'purchaseToViewRate']));
        return $this;
    }

    public function purchaserConversionRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'purchaserConversionRate']));
        return $this;
    }

    public function returnOnAdSpend(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'returnOnAdSpend']));
        return $this;
    }

    public function screenPageViews(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'screenPageViews']));
        return $this;
    }

    public function screenPageViewsPerSession(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'screenPageViewsPerSession']));
        return $this;
    }

    public function sessionConversionRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'sessionConversionRate']));
        return $this;
    }

    public function sessions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'sessions']));
        return $this;
    }

    public function sessionsPerUser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'sessionsPerUser']));
        return $this;
    }

    public function shippingAmount(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'shippingAmount']));
        return $this;
    }

    public function taxAmount(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'taxAmount']));
        return $this;
    }

    public function totalAdRevenue(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'totalAdRevenue']));
        return $this;
    }

    public function totalPurchasers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'totalPurchasers']));
        return $this;
    }

    public function totalRevenue(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'totalRevenue']));
        return $this;
    }

    public function totalUsers(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'totalUsers']));
        return $this;
    }

    public function transactions(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'transactions']));
        return $this;
    }

    public function transactionsPerPurchaser(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'transactionsPerPurchaser']));
        return $this;
    }

    public function userConversionRate(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'userConversionRate']));
        return $this;
    }

    public function userEngagementDuration(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'userEngagementDuration']));
        return $this;
    }

    public function wauPerMau(): Metrics
    {
        $this->metrics->push(new Metric(['name' => 'wauPerMau']));
        return $this;
    }

}
