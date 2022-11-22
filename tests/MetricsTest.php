<?php

namespace Tests;

use GarrettMassey\Analytics\Analytics;
use GarrettMassey\Analytics\Parameters\Metrics;
use Orchestra\Testbench\TestCase as Orchestra;

class MetricsTest extends Orchestra
{
    /*
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'GarrettMassey\\Analytics\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AnalyticsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
    */

    /** @test */
    public function assert_get_metrics_returns_collection()
    {
        $metrics = new Metrics();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $metrics->getMetrics());
    }

    /** @test */
    public function assert_setting_methods_return_metrics_class()
    {
        $metrics = new Metrics();
        //first create a new metric class
        $metrics = new Metrics();
        //then run all the methods on that class
        $this->assertInstanceOf(Metrics::class, $metrics->active1DayUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->active28DayUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->active7DayUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->activeUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->adUnitExposure());
        $this->assertInstanceOf(Metrics::class, $metrics->addToCarts());
        $this->assertInstanceOf(Metrics::class, $metrics->advertiserAdClicks());
        $this->assertInstanceOf(Metrics::class, $metrics->advertiserAdCost());
        $this->assertInstanceOf(Metrics::class, $metrics->advertiserAdCostPerClick());
        $this->assertInstanceOf(Metrics::class, $metrics->advertiserAdCostPerConversion());
        $this->assertInstanceOf(Metrics::class, $metrics->advertiserAdImpressions());
        $this->assertInstanceOf(Metrics::class, $metrics->averagePurchaseRevenue());
        $this->assertInstanceOf(Metrics::class, $metrics->averagePurchaseRevenuePerPayingUser());
        $this->assertInstanceOf(Metrics::class, $metrics->averagePurchaseRevenuePerUser());
        $this->assertInstanceOf(Metrics::class, $metrics->averageRevenuePerUser());
        $this->assertInstanceOf(Metrics::class, $metrics->averageSessionDuration());
        $this->assertInstanceOf(Metrics::class, $metrics->bounceRate());
        $this->assertInstanceOf(Metrics::class, $metrics->cartToViewRate());
        $this->assertInstanceOf(Metrics::class, $metrics->checkouts());
        $this->assertInstanceOf(Metrics::class, $metrics->cohortActiveUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->cohortTotalUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->conversions());
        $this->assertInstanceOf(Metrics::class, $metrics->crashAffectedUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->crashFreeUsersRate());
        $this->assertInstanceOf(Metrics::class, $metrics->dauPerMau());
        $this->assertInstanceOf(Metrics::class, $metrics->dauPerWau());
        $this->assertInstanceOf(Metrics::class, $metrics->ecommercePurchases());
        $this->assertInstanceOf(Metrics::class, $metrics->engagedSessions());
        $this->assertInstanceOf(Metrics::class, $metrics->engagementRate());
        $this->assertInstanceOf(Metrics::class, $metrics->eventCount());
        $this->assertInstanceOf(Metrics::class, $metrics->eventCountPerUser());
        $this->assertInstanceOf(Metrics::class, $metrics->eventValue());
        $this->assertInstanceOf(Metrics::class, $metrics->eventsPerSession());
        $this->assertInstanceOf(Metrics::class, $metrics->firstTimePurchaserConversionRate());
        $this->assertInstanceOf(Metrics::class, $metrics->firstTimePurchasers());
        $this->assertInstanceOf(Metrics::class, $metrics->firstTimePurchasersPerNewUser());
        $this->assertInstanceOf(Metrics::class, $metrics->itemListClickEvents());
        $this->assertInstanceOf(Metrics::class, $metrics->itemListClickThroughRate());
        $this->assertInstanceOf(Metrics::class, $metrics->itemListViewEvents());
        $this->assertInstanceOf(Metrics::class, $metrics->itemPromotionClickThroughRate());
        $this->assertInstanceOf(Metrics::class, $metrics->itemRevenue());
        $this->assertInstanceOf(Metrics::class, $metrics->itemViewEvents());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsAddedToCart());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsCheckedOut());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsClickedInList());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsClickedInPromotion());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsPurchased());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsViewed());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsViewedInList());
        $this->assertInstanceOf(Metrics::class, $metrics->itemsViewedInPromotion());
        $this->assertInstanceOf(Metrics::class, $metrics->newUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->organicGoogleSearchAveragePosition());
        $this->assertInstanceOf(Metrics::class, $metrics->organicGoogleSearchClickThroughRate());
        $this->assertInstanceOf(Metrics::class, $metrics->organicGoogleSearchClicks());
        $this->assertInstanceOf(Metrics::class, $metrics->organicGoogleSearchImpressions());
        $this->assertInstanceOf(Metrics::class, $metrics->promotionClicks());
        $this->assertInstanceOf(Metrics::class, $metrics->promotionViews());
        $this->assertInstanceOf(Metrics::class, $metrics->publisherAdClicks());
        $this->assertInstanceOf(Metrics::class, $metrics->publisherAdImpressions());
        $this->assertInstanceOf(Metrics::class, $metrics->purchaseRevenue());
        $this->assertInstanceOf(Metrics::class, $metrics->purchaseToViewRate());
        $this->assertInstanceOf(Metrics::class, $metrics->purchaserConversionRate());
        $this->assertInstanceOf(Metrics::class, $metrics->returnOnAdSpend());
        $this->assertInstanceOf(Metrics::class, $metrics->screenPageViews());
        $this->assertInstanceOf(Metrics::class, $metrics->screenPageViewsPerSession());
        $this->assertInstanceOf(Metrics::class, $metrics->sessionConversionRate());
        $this->assertInstanceOf(Metrics::class, $metrics->sessions());
        $this->assertInstanceOf(Metrics::class, $metrics->sessionsPerUser());
        $this->assertInstanceOf(Metrics::class, $metrics->shippingAmount());
        $this->assertInstanceOf(Metrics::class, $metrics->taxAmount());
        $this->assertInstanceOf(Metrics::class, $metrics->totalAdRevenue());
        $this->assertInstanceOf(Metrics::class, $metrics->totalPurchasers());
        $this->assertInstanceOf(Metrics::class, $metrics->totalRevenue());
        $this->assertInstanceOf(Metrics::class, $metrics->totalUsers());
        $this->assertInstanceOf(Metrics::class, $metrics->transactions());
        $this->assertInstanceOf(Metrics::class, $metrics->transactionsPerPurchaser());
        $this->assertInstanceOf(Metrics::class, $metrics->userConversionRate());
        $this->assertInstanceOf(Metrics::class, $metrics->userEngagementDuration());
        $this->assertInstanceOf(Metrics::class, $metrics->wauPerMau());
    }

    /** @test */
    public function metrics_class_property_only_contains_google_metrics_class()
    {
        //first create a new metric class
        $metrics = new Metrics();
        //then run all the methods on that class
        $metrics->active1DayUsers();
        $metrics->active28DayUsers();
        $metrics->active7DayUsers();
        $metrics->activeUsers();
        $metrics->adUnitExposure();
        $metrics->addToCarts();
        $metrics->advertiserAdClicks();
        $metrics->advertiserAdCost();
        $metrics->advertiserAdCostPerClick();
        $metrics->advertiserAdCostPerConversion();
        $metrics->advertiserAdImpressions();
        $metrics->averagePurchaseRevenue();
        $metrics->averagePurchaseRevenuePerPayingUser();
        $metrics->averagePurchaseRevenuePerUser();
        $metrics->averageRevenuePerUser();
        $metrics->averageSessionDuration();
        $metrics->bounceRate();
        $metrics->cartToViewRate();
        $metrics->checkouts();
        $metrics->cohortActiveUsers();
        $metrics->cohortTotalUsers();
        $metrics->conversions();
        $metrics->crashAffectedUsers();
        $metrics->crashFreeUsersRate();
        $metrics->dauPerMau();
        $metrics->dauPerWau();
        $metrics->ecommercePurchases();
        $metrics->engagedSessions();
        $metrics->engagementRate();
        $metrics->eventCount();
        $metrics->eventCountPerUser();
        $metrics->eventValue();
        $metrics->eventsPerSession();
        $metrics->firstTimePurchaserConversionRate();
        $metrics->firstTimePurchasers();
        $metrics->firstTimePurchasersPerNewUser();
        $metrics->itemListClickEvents();
        $metrics->itemListClickThroughRate();
        $metrics->itemListViewEvents();
        $metrics->itemPromotionClickThroughRate();
        $metrics->itemRevenue();
        $metrics->itemViewEvents();
        $metrics->itemsAddedToCart();
        $metrics->itemsCheckedOut();
        $metrics->itemsClickedInList();
        $metrics->itemsClickedInPromotion();
        $metrics->itemsPurchased();
        $metrics->itemsViewed();
        $metrics->itemsViewedInList();
        $metrics->itemsViewedInPromotion();
        $metrics->newUsers();
        $metrics->organicGoogleSearchAveragePosition();
        $metrics->organicGoogleSearchClickThroughRate();
        $metrics->organicGoogleSearchClicks();
        $metrics->organicGoogleSearchImpressions();
        $metrics->promotionClicks();
        $metrics->promotionViews();
        $metrics->publisherAdClicks();
        $metrics->publisherAdImpressions();
        $metrics->purchaseRevenue();
        $metrics->purchaseToViewRate();
        $metrics->purchaserConversionRate();
        $metrics->returnOnAdSpend();
        $metrics->screenPageViews();
        $metrics->screenPageViewsPerSession();
        $metrics->sessionConversionRate();
        $metrics->sessions();
        $metrics->sessionsPerUser();
        $metrics->shippingAmount();
        $metrics->taxAmount();
        $metrics->totalAdRevenue();
        $metrics->totalPurchasers();
        $metrics->totalRevenue();
        $metrics->totalUsers();
        $metrics->transactions();
        $metrics->transactionsPerPurchaser();
        $metrics->userConversionRate();
        $metrics->userEngagementDuration();
        $metrics->wauPerMau();

        //now check that the $metrics property in
        //$metrics class is a collection of ONLY
        //\Google\Analytics\Data\V1beta\Metric objects
        $allMetrics = $metrics->getMetrics();
        foreach ($allMetrics as $metric) {
            $this->assertInstanceOf(\Google\Analytics\Data\V1beta\Metric::class, $metric);
        }
    }
}
