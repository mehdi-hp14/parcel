<?php

namespace Kaban\Core\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Kaban\General\Events\AdminSentTicket;
use Kaban\General\Events\AdminSubmittedMomentDiscussion;
use Kaban\General\Events\AdminSubmittedReviewDiscussion;
use Kaban\General\Events\AgencyRegistered;
use Kaban\General\Events\AgencySentTicket;
use Kaban\General\Events\AgencySentTourDiscussion;
use Kaban\General\Events\AgencySpendCreated;
use Kaban\General\Events\AgencyTelereservationCreated;
use Kaban\General\Events\AgencyTelereservationRemoved;
use Kaban\General\Events\AgencyTelereservationUpdated;
use Kaban\General\Events\AgencyUpdated;
use Kaban\General\Events\AmendCreated;
use Kaban\General\Events\AmendStatusUpdated;
use Kaban\General\Events\CategoryUpdated;
use Kaban\General\Events\CommentsSubmitted;
use Kaban\General\Events\DailytripDiscussionSubmitted;
use Kaban\General\Events\DailytripSubmitted;
use Kaban\General\Events\DiscussionSubmitted;
use Kaban\General\Events\FoodCreated;
use Kaban\General\Events\HotelUpdated;
use Kaban\General\Events\InquirySent;
use Kaban\General\Events\InvoiceUpdated;
use Kaban\General\Events\LastgramRequestApproved;
use Kaban\General\Events\LocationUpdated;
use Kaban\General\Events\MomentUpdated;
use Kaban\General\Events\PenaltySubmitted;
use Kaban\General\Events\PostUpdated;
use Kaban\General\Events\ReactionCreated;
use Kaban\General\Events\ReviewDiscussionSubmitted;
use Kaban\General\Events\ReviewImageSubmitted;
use Kaban\General\Events\ReviewSubmitted;
use Kaban\General\Events\TicketReplied;
use Kaban\General\Events\TourUpdated;
use Kaban\General\Events\TravelDiscussionSubmitted;
use Kaban\General\Events\TravelmemoryDiscussionSubmitted;
use Kaban\General\Events\TravelmemoryLikeSubmitted;
use Kaban\General\Events\TravelmemoryParticipatedInCompetition;
use Kaban\General\Events\TravelmemorySubmitted;
use Kaban\General\Events\TravelmemoryUpdated;
use Kaban\General\Events\TravelogueDiscussionSubmitted;
use Kaban\General\Events\TraveloguesLikeSubmitted;
use Kaban\General\Events\TraveloguesParticipatedInCompetition;
use Kaban\General\Events\TraveloguesSubmitted;
use Kaban\General\Events\TravelogueUpdated;
use Kaban\General\Events\TravelsSubmitted;
use Kaban\General\Events\UserEntityLiked;
use Kaban\General\Events\UserEntityUnliked;
use Kaban\General\Events\UserUpdated;
use Kaban\General\Events\VideoDiscussionSubmitted;
use Kaban\General\Events\VideosLikeSubmitted;
use Kaban\General\Events\VideosParticipatedInCompetition;
use Kaban\General\Events\VideosSubmitted;
use Kaban\General\Events\ViolationSent;
use Kaban\General\Listeners\CalculateLocationFeaturesPopularity;
use Kaban\General\Listeners\CalculateReactableStatistics;
use Kaban\General\Listeners\CalculateRestaurantPriceRange;
use Kaban\General\Listeners\CalculateReviewableStatistics;
use Kaban\General\Listeners\CheckAgenciesServicesCount;
use Kaban\General\Listeners\DecreaseUserLikes;
use Kaban\General\Listeners\HandleSomething;
use Kaban\General\Listeners\ManageInvoiceSubscription;
use Kaban\General\Listeners\NotifyAdminsDailytripSubmitted;
use Kaban\General\Listeners\NotifyAdminsFoodCreated;
use Kaban\General\Listeners\NotifyAdminsPenaltySubmitted;
use Kaban\General\Listeners\NotifyAdminsTravelmemoriesSubmitted;
use Kaban\General\Listeners\NotifyCustomersDailytripSubmitted;
use Kaban\General\Listeners\NotifyCustomersTravelmemoriesSubmitted;
use Kaban\General\Listeners\NotifyReceiversDailytripDiscussionSubmitted;
use Kaban\General\Listeners\NotifyReceiversTravelmemoriesDiscussionSubmitted;
use Kaban\General\Listeners\NotifyTravelmemoriesAuthorsOnCommentSubmitted;
use Kaban\General\Listeners\NotifyTravelmemoriesAuthorsOnLikeSubmitted;
use Kaban\General\Listeners\NotifyTravelmemoriesAuthorsWhenTravelmemoryParticipatedInCompetition;
use Kaban\General\Listeners\RemoveTravelogueSitemapCache;
use Kaban\General\Listeners\SendLastgramCommentApprovalNotification;
use Kaban\General\Listeners\SendLastgramMomentDiscussionNotification;
use Kaban\General\Listeners\SendLastgramReviewDiscussionNotification;
use Kaban\General\Listeners\SendReviewStatusNotification;
use Kaban\General\Listeners\SetReviewApprovedAt;
use Kaban\General\Listeners\UpdateLastgramerMomentsCount;
use Kaban\General\Listeners\IncreaseUserLikes;
use Kaban\General\Listeners\IssueTicketAssigneeChangedComment;
use Kaban\General\Listeners\IssueTicketStatusChangedComment;
use Kaban\General\Listeners\LogIt;
use Kaban\General\Listeners\ManageTreks;
use Kaban\General\Listeners\NotifyAdminsAgencyRegistered;
use Kaban\General\Listeners\NotifyAdminsAmendCreated;
use Kaban\General\Listeners\NotifyAdminsTraveloguesSubmitted;
use Kaban\General\Listeners\NotifyAdminsTravelsSubmitted;
use Kaban\General\Listeners\NotifyAdminsVideosSubmitted;
use Kaban\General\Listeners\NotifyCustomersTraveloguesSubmitted;
use Kaban\General\Listeners\NotifyCustomersTravelsSubmitted;
use Kaban\General\Listeners\NotifyCustomersVideosSubmitted;
use Kaban\General\Listeners\NotifyReceiversTraveloguesDiscussionSubmitted;
use Kaban\General\Listeners\NotifyReceiversTravelsDiscussionSubmitted;
use Kaban\General\Listeners\NotifyReceiversVideosDiscussionSubmitted;
use Kaban\General\Listeners\NotifyReviewDiscussionReceivers;
use Kaban\General\Listeners\NotifyTraveloguesAuthorsOnCommentSubmitted;
use Kaban\General\Listeners\NotifyTraveloguesAuthorsOnLikeSubmitted;
use Kaban\General\Listeners\NotifyTraveloguesAuthorsWhenTravelogueParticipatedInCompetition;
use Kaban\General\Listeners\NotifyUsersOnCommentReplied;
use Kaban\General\Listeners\NotifyVideosAuthorsOnCommentSubmitted;
use Kaban\General\Listeners\NotifyVideosAuthorsOnLikeSubmitted;
use Kaban\General\Listeners\NotifyVideosAuthorsWhenVideoParticipatedInCompetition;
use Kaban\General\Listeners\NotifyUserAmendCreated;
use Kaban\General\Listeners\NotifyUserAmendStatusUpdated;
use Kaban\General\Listeners\RemoveAgencySitemapCache;
use Kaban\General\Listeners\RemoveCategorySitemapCache;
use Kaban\General\Listeners\RemoveHotelSitemapCache;
use Kaban\General\Listeners\RemoveLocationHotelSitemapCache;
use Kaban\General\Listeners\RemoveLocationTourSitemapCache;
use Kaban\General\Listeners\RemoveLocationTravelogueSitemapCache;
use Kaban\General\Listeners\RemovePostSitemapCache;
use Kaban\General\Listeners\RemoveTourSitemapCache;
use Kaban\General\Listeners\RemoveTravelmemorySitemapCache;
use Kaban\General\Listeners\SendAdminReviewEditionNotification;
use Kaban\General\Listeners\SendAdminReviewImageUploadedNotification;
use Kaban\General\Listeners\SendAdminTelereservationNotification;
use Kaban\General\Listeners\SendAdminTelereservationRemoveNotification;
use Kaban\General\Listeners\SendAdminTelereservationUpdateNotification;
use Kaban\General\Listeners\SendAdminTicketNotification;
use Kaban\General\Listeners\SendAdminViolationReportNotification;
use Kaban\General\Listeners\SendAgencySpendNotification;
use Kaban\General\Listeners\SendAgencyTelereservationNotification;
use Kaban\General\Listeners\SendAgencyTelereservationRemoveNotification;
use Kaban\General\Listeners\SendAgencyTelereservationUpdateNotification;
use Kaban\General\Listeners\SendAgencyTicketNotification;
use Kaban\General\Listeners\SendDiscussionReceiversNotification;
use Kaban\General\Listeners\SendInquiryDepartmentNotification;
use Kaban\General\Listeners\SendLastgramRequestApprovedNotification;
use Kaban\General\Listeners\SendMomentApprovalNotification;
use Kaban\General\Listeners\SendThankYouEmailToUserForInquiry;
use Kaban\General\Listeners\SendTicketDiscussionNotification;
use Kaban\General\Listeners\SendUserReviewActivationNotification;
use Kaban\General\Listeners\SendUserReviewDiscussionNotification;
use Kaban\General\Listeners\SendUserReviewEditionNotification;
use Kaban\General\Listeners\SendUserReviewSubmissionNotification;
use Kaban\General\Listeners\SendUserViolationReportNotification;
use Kaban\General\Listeners\SendWelcomeEmailToAgencyForRegistration;
use Kaban\General\Listeners\CheckAgenciesToursForIllegalLocation;
use Kaban\General\Listeners\UpdateMomentSpot;
use Kaban\General\Listeners\UpdateReviewableLastReviewedAt;
use Kaban\General\Listeners\UpdateReviewSight;
use Kaban\General\Listeners\UserAvatarUploadedNotifications;
use Kaban\Models\Dailytrip;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AgencyRegistered::class => [
            NotifyAdminsAgencyRegistered::class,
            SendWelcomeEmailToAgencyForRegistration::class,
            LogIt::class,
        ],
        TicketReplied::class => [
            IssueTicketStatusChangedComment::class,
            IssueTicketAssigneeChangedComment::class,
            SendTicketDiscussionNotification::class,
        ],
        TraveloguesSubmitted::class => [
            NotifyAdminsTraveloguesSubmitted::class,
            NotifyCustomersTraveloguesSubmitted::class,
        ],
        TravelmemorySubmitted::class => [
            NotifyAdminsTravelmemoriesSubmitted::class,
            NotifyCustomersTravelmemoriesSubmitted::class,
        ],
        DailytripSubmitted::class => [
            NotifyAdminsDailytripSubmitted::class,
            NotifyCustomersDailytripSubmitted::class,
        ],
        VideosSubmitted::class => [
            NotifyAdminsVideosSubmitted::class,
            NotifyCustomersVideosSubmitted::class,
        ],
        TravelsSubmitted::class => [
            NotifyAdminsTravelsSubmitted::class,
            NotifyCustomersTravelsSubmitted::class,
        ],
        CommentsSubmitted::class => [
            NotifyTraveloguesAuthorsOnCommentSubmitted::class,
            NotifyTravelmemoriesAuthorsOnCommentSubmitted::class,
            NotifyVideosAuthorsOnCommentSubmitted::class,
            NotifyUsersOnCommentReplied::class,
            SendLastgramCommentApprovalNotification::class,
        ],
        TraveloguesLikeSubmitted::class => [
            NotifyTraveloguesAuthorsOnLikeSubmitted::class,
        ],
        TravelmemoryLikeSubmitted::class => [
            NotifyTravelmemoriesAuthorsOnLikeSubmitted::class,
        ],
        VideosLikeSubmitted::class => [
            NotifyVideosAuthorsOnLikeSubmitted::class,
        ],
        TraveloguesParticipatedInCompetition::class => [
            NotifyTraveloguesAuthorsWhenTravelogueParticipatedInCompetition::class,
        ],
        TravelmemoryParticipatedInCompetition::class => [
            NotifyTravelmemoriesAuthorsWhenTravelmemoryParticipatedInCompetition::class,
        ],
        VideosParticipatedInCompetition::class => [
            NotifyVideosAuthorsWhenVideoParticipatedInCompetition::class,
        ],
        ReviewSubmitted::class => [
            SendUserReviewActivationNotification::class,
            CalculateReviewableStatistics::class,
            CalculateRestaurantPriceRange::class,
            CalculateLocationFeaturesPopularity::class,
//            SendUserReviewSubmissionNotification::class,
//            SendUserReviewEditionNotification::class,
//            SendAdminReviewEditionNotification::class,
//            SetReviewApprovedAt::class,
            UpdateReviewSight::class,
            UpdateReviewableLastReviewedAt::class,
            SendReviewStatusNotification::class,
        ],
        ReviewImageSubmitted::class => [
            SendAdminReviewImageUploadedNotification::class,
        ],
        AdminSubmittedReviewDiscussion::class => [
            SendUserReviewDiscussionNotification::class,
            SendLastgramReviewDiscussionNotification::class,
        ],
        TourUpdated::class => [
            //'Kaban\General\Listeners\SyncLastsecondWithOldLastsecond',
//            MakeTiersFromTourDetails::class,
            RemoveTourSitemapCache::class,
            ManageTreks::class,
        ],
        UserUpdated::class => [
            UserAvatarUploadedNotifications::class,
        ],
        AgencySentTourDiscussion::class => [
            //'Kaban\General\Listeners\SendTourDiscussionToAdmin',
        ],
        AgencySentTicket::class => [
            SendAgencyTicketNotification::class,
        ],
        AdminSentTicket::class => [
            SendAdminTicketNotification::class,
        ],
        InquirySent::class => [
            SendThankYouEmailToUserForInquiry::class,
            SendInquiryDepartmentNotification::class,
        ],
        DiscussionSubmitted::class => [
            SendDiscussionReceiversNotification::class,
        ],
        TravelogueDiscussionSubmitted::class => [
            NotifyReceiversTraveloguesDiscussionSubmitted::class,
        ],
        TravelmemoryDiscussionSubmitted::class => [
            NotifyReceiversTravelmemoriesDiscussionSubmitted::class,
        ],
        DailytripDiscussionSubmitted::class => [
            NotifyReceiversDailytripDiscussionSubmitted::class,
        ],
        VideoDiscussionSubmitted::class => [
            NotifyReceiversVideosDiscussionSubmitted::class,
        ],
        TravelDiscussionSubmitted::class => [
            NotifyReceiversTravelsDiscussionSubmitted::class,
        ],
        ViolationSent::class => [
            SendUserViolationReportNotification::class,
            SendAdminViolationReportNotification::class,
        ],
        AgencySpendCreated::class => [
            SendAgencySpendNotification::class,
        ],
        ReviewDiscussionSubmitted::class => [
            NotifyReviewDiscussionReceivers::class,
        ],
        AgencyTelereservationCreated::class => [
            SendAgencyTelereservationNotification::class,
            SendAdminTelereservationNotification::class,
        ],
        AgencyTelereservationUpdated::class => [
            SendAgencyTelereservationUpdateNotification::class,
            SendAdminTelereservationUpdateNotification::class,
        ],
        AgencyTelereservationRemoved::class => [
            SendAgencyTelereservationRemoveNotification::class,
            SendAdminTelereservationRemoveNotification::class,
        ],
        UserEntityLiked::class => [
            IncreaseUserLikes::class,
//            RewardUsersForLike::class,
        ],
        UserEntityUnliked::class => [
            DecreaseUserLikes::class,
        ],
        LocationUpdated::class => [
            RemoveLocationTourSitemapCache::class,
            RemoveLocationHotelSitemapCache::class,
            RemoveLocationTravelogueSitemapCache::class,
            RemoveTravelmemorySitemapCache::class,
        ],
        HotelUpdated::class => [
            RemoveHotelSitemapCache::class
        ],
        AgencyUpdated::class => [
            RemoveAgencySitemapCache::class,
            CheckAgenciesToursForIllegalLocation::class,
            CheckAgenciesServicesCount::class,
        ],
        PostUpdated::class => [
            RemovePostSitemapCache::class,
        ],
        CategoryUpdated::class => [
            RemoveCategorySitemapCache::class,
        ],
        TravelogueUpdated::class => [
            RemoveTravelogueSitemapCache::class,
        ],
        TravelmemoryUpdated::class => [
            RemoveTravelmemorySitemapCache::class,
        ],
        LastgramRequestApproved::class => [
            SendLastgramRequestApprovedNotification::class,
        ],

        MomentUpdated::class => [
            UpdateLastgramerMomentsCount::class,
            SendMomentApprovalNotification::class,
            UpdateMomentSpot::class,
        ],
        AdminSubmittedMomentDiscussion::class => [
            SendLastgramMomentDiscussionNotification::class,
        ],
        InvoiceUpdated::class => [
            ManageInvoiceSubscription::class,
        ],

        AmendCreated::class => [
            NotifyAdminsAmendCreated::class,
            NotifyUserAmendCreated::class,
        ],
        AmendStatusUpdated::class => [
            NotifyUserAmendStatusUpdated::class,
        ],
        PenaltySubmitted::class => [
            NotifyAdminsPenaltySubmitted::class
        ],
        ReactionCreated::class => [
            CalculateReactableStatistics::class,
        ],
        FoodCreated::class => [
            NotifyAdminsFoodCreated::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
