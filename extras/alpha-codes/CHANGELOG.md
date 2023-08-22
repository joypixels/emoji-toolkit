changelog
---------

#### 8.0 / 2023-08-21
* additions
  * Unicode 15 characters

#### UPDATE 2019-07-22
* additions
  * Unicode 12 characters
 

#### UPDATE 2017-06-30
* additions
  * Unicode 10 characters
  
* changes
  * inclusion of output code point attribute, used to generate native Unicode
  

#### UPDATE 2017-04-15
* additions
  * gender based roles
  * aliases for diversity naming convention (e.g. tone1 = light_skin_tone)
  
* changes
  * in a previous version, csv columns were renamed to more closely match the json attribute labels. now we've updated "alpha code" to "alpha_code" for closer alignment
  * we've removed the versioning from this data set now that it's part of the JoyPixels repo
  * The following is a list of shortnames that have been moved into the ":aliases:" column and replaced by a new primary shortname (alpha code), as of the JoyPixels 3.0 update.

```
Previous Shortname,New Shortname

:golfer:,:person_golfing:

:man_with_turban:,:person_wearing_turban:

:man_with_turban_tone1:,:person_wearing_turban_tone1:

:man_with_turban_tone2:,:person_wearing_turban_tone2:

:man_with_turban_tone3:,:person_wearing_turban_tone3:

:man_with_turban_tone4:,:person_wearing_turban_tone4:

:man_with_turban_tone5:,:person_wearing_turban_tone5:

:man_with_gua_pi_mao:,:man_with_chinese_cap:

:man_with_gua_pi_mao_tone1:,:man_with_chinese_cap_tone1:

:man_with_gua_pi_mao_tone2:,:man_with_chinese_cap_tone2:

:man_with_gua_pi_mao_tone3:,:man_with_chinese_cap_tone3:

:man_with_gua_pi_mao_tone4:,:man_with_chinese_cap_tone4:

:man_with_gua_pi_mao_tone5:,:man_with_chinese_cap_tone5:

:dancers:,:people_with_bunny_ears_partying:

:runner:,:person_running:

:runner_tone1:,:person_running_tone1:

:runner_tone2:,:person_running_tone2:

:runner_tone3:,:person_running_tone3:

:runner_tone4:,:person_running_tone4:

:runner_tone5:,:person_running_tone5:

:walking:,:person_walking:

:walking_tone1:,:person_walking_tone1:

:walking_tone2:,:person_walking_tone2:

:walking_tone3:,:person_walking_tone3:

:walking_tone4:,:person_walking_tone4:

:walking_tone5:,:person_walking_tone5:

:haircut:,:person_getting_haircut:

:haircut_tone1:,:person_getting_haircut_tone1:

:haircut_tone2:,:person_getting_haircut_tone2:

:haircut_tone3:,:person_getting_haircut_tone3:

:haircut_tone4:,:person_getting_haircut_tone4:

:haircut_tone5:,:person_getting_haircut_tone5:

:massage:,:person_getting_massage:

:massage_tone1:,:person_getting_massage_tone1:

:massage_tone2:,:person_getting_massage_tone2:

:massage_tone3:,:person_getting_massage_tone3:

:massage_tone4:,:person_getting_massage_tone4:

:massage_tone5:,:person_getting_massage_tone5:

:shrug:,:person_shrugging:

:shrug_tone1:,:person_shrugging_tone1:

:shrug_tone2:,:person_shrugging_tone2:

:shrug_tone3:,:person_shrugging_tone3:

:shrug_tone4:,:person_shrugging_tone4:

:shrug_tone5:,:person_shrugging_tone5:

:face_palm:,:person_facepalming:

:face_palm_tone1:,:person_facepalming_tone1:

:face_palm_tone2:,:person_facepalming_tone2:

:face_palm_tone3:,:person_facepalming_tone3:

:face_palm_tone4:,:person_facepalming_tone4:

:face_palm_tone5:,:person_facepalming_tone5:

:wrestlers:,:people_wrestling:

:cop:,:police_officer:

:cop_tone1:,:police_officer_tone1:

:cop_tone2:,:police_officer_tone2:

:cop_tone3:,:police_officer_tone3:

:cop_tone4:,:police_officer_tone4:

:cop_tone5:,:police_officer_tone5:

:spy:,:detective:

:spy_tone1:,:detective_tone1:

:spy_tone2:,:detective_tone2:

:spy_tone3:,:detective_tone3:

:spy_tone4:,:detective_tone4:

:spy_tone5:,:detective_tone5:

:guardsman:,:guard:

:guardsman_tone1:,:guard_tone1:

:guardsman_tone2:,:guard_tone2:

:guardsman_tone3:,:guard_tone3:

:guardsman_tone4:,:guard_tone4:

:guardsman_tone5:,:guard_tone5:

:person_with_blond_hair:,:blond_haired_person:

:person_with_blond_hair_tone1:,:blond_haired_person_tone1:

:person_with_blond_hair_tone2:,:blond_haired_person_tone2:

:person_with_blond_hair_tone3:,:blond_haired_person_tone3:

:person_with_blond_hair_tone4:,:blond_haired_person_tone4:

:person_with_blond_hair_tone5:,:blond_haired_person_tone5:

:person_with_pouting_face:,:person_pouting:

:person_with_pouting_face_tone1:,:person_pouting_tone1:

:person_with_pouting_face_tone2:,:person_pouting_tone2:

:person_with_pouting_face_tone3:,:person_pouting_tone3:

:person_with_pouting_face_tone4:,:person_pouting_tone4:

:person_with_pouting_face_tone5:,:person_pouting_tone5:

:no_good:,:person_gesturing_no:

:no_good_tone1:,:person_gesturing_no_tone1:

:no_good_tone2:,:person_gesturing_no_tone2:

:no_good_tone3:,:person_gesturing_no_tone3:

:no_good_tone4:,:person_gesturing_no_tone4:

:no_good_tone5:,:person_gesturing_no_tone5:

:ok_woman:,:person_gesturing_ok:

:ok_woman_tone1:,:person_gesturing_ok_tone1:

:ok_woman_tone2:,:person_gesturing_ok_tone2:

:ok_woman_tone3:,:person_gesturing_ok_tone3:

:ok_woman_tone4:,:person_gesturing_ok_tone4:

:ok_woman_tone5:,:person_gesturing_ok_tone5:

:information_desk_person:,:person_tipping_hand:

:information_desk_person_tone1:,:person_tipping_hand_tone1:

:information_desk_person_tone2:,:person_tipping_hand_tone2:

:information_desk_person_tone3:,:person_tipping_hand_tone3:

:information_desk_person_tone4:,:person_tipping_hand_tone4:

:information_desk_person_tone5:,:person_tipping_hand_tone5:

:raising_hand:,:person_raising_hand:

:raising_hand_tone1:,:person_raising_hand_tone1:

:raising_hand_tone2:,:person_raising_hand_tone2:

:raising_hand_tone3:,:person_raising_hand_tone3:

:raising_hand_tone4:,:person_raising_hand_tone4:

:raising_hand_tone5:,:person_raising_hand_tone5:

:bow:,:person_bowing:

:bow_tone1:,:person_bowing_tone1:

:bow_tone2:,:person_bowing_tone2:

:bow_tone3:,:person_bowing_tone3:

:bow_tone4:,:person_bowing_tone4:

:bow_tone5:,:person_bowing_tone5:

:fencer:,:person_fencing:

:surfer:,:person_surfing:

:surfer_tone1:,:person_surfing_tone1:

:surfer_tone2:,:person_surfing_tone2:

:surfer_tone3:,:person_surfing_tone3:

:surfer_tone4:,:person_surfing_tone4:

:surfer_tone5:,:person_surfing_tone5:

:rowboat:,:person_rowing_boat:

:rowboat_tone1:,:person_rowing_boat_tone1:

:rowboat_tone2:,:person_rowing_boat_tone2:

:rowboat_tone3:,:person_rowing_boat_tone3:

:rowboat_tone4:,:person_rowing_boat_tone4:

:rowboat_tone5:,:person_rowing_boat_tone5:

:swimmer:,:person_swimming:

:swimmer_tone1:,:person_swimming_tone1:

:swimmer_tone2:,:person_swimming_tone2:

:swimmer_tone3:,:person_swimming_tone3:

:swimmer_tone4:,:person_swimming_tone4:

:swimmer_tone5:,:person_swimming_tone5:

:basketball_player:,:person_bouncing_ball:

:basketball_player_tone1:,:person_bouncing_ball_tone1:

:basketball_player_tone2:,:person_bouncing_ball_tone2:

:basketball_player_tone3:,:person_bouncing_ball_tone3:

:basketball_player_tone4:,:person_bouncing_ball_tone4:

:basketball_player_tone5:,:person_bouncing_ball_tone5:

:lifter:,:person_lifting_weights:

:lifter_tone1:,:person_lifting_weights_tone1:

:lifter_tone2:,:person_lifting_weights_tone2:

:lifter_tone3:,:person_lifting_weights_tone3:

:lifter_tone4:,:person_lifting_weights_tone4:

:lifter_tone5:,:person_lifting_weights_tone5:

:bicyclist:,:person_biking:

:bicyclist_tone1:,:person_biking_tone1:

:bicyclist_tone2:,:person_biking_tone2:

:bicyclist_tone3:,:person_biking_tone3:

:bicyclist_tone4:,:person_biking_tone4:

:bicyclist_tone5:,:person_biking_tone5:

:mountain_bicyclist:,:person_mountain_biking:

:mountain_bicyclist_tone1:,:person_mountain_biking_tone1:

:mountain_bicyclist_tone2:,:person_mountain_biking_tone2:

:mountain_bicyclist_tone3:,:person_mountain_biking_tone3:

:mountain_bicyclist_tone4:,:person_mountain_biking_tone4:

:mountain_bicyclist_tone5:,:person_mountain_biking_tone5:

:water_polo:,:person_playing_water_polo:

:water_polo_tone1:,:person_playing_water_polo_tone1:

:water_polo_tone2:,:person_playing_water_polo_tone2:

:water_polo_tone3:,:person_playing_water_polo_tone3:

:water_polo_tone4:,:person_playing_water_polo_tone4:

:water_polo_tone5:,:person_playing_water_polo_tone5:

:handball:,:person_playing_handball:

:handball_tone1:,:person_playing_handball_tone1:

:handball_tone2:,:person_playing_handball_tone2:

:handball_tone3:,:person_playing_handball_tone3:

:handball_tone4:,:person_playing_handball_tone4:

:handball_tone5:,:person_playing_handball_tone5:

:juggling:,:person_juggling:

:juggling_tone1:,:person_juggling_tone1:

:juggling_tone2:,:person_juggling_tone2:

:juggling_tone3:,:person_juggling_tone3:

:juggling_tone4:,:person_juggling_tone4:

:juggling_tone5:,:person_juggling_tone5:

:levitating:,:man_in_business_suit_levitating:

:cartwheel:,:person_doing_cartwheel:

:cartwheel_tone1:,:person_doing_cartwheel_tone1:

:cartwheel_tone2:,:person_doing_cartwheel_tone2:

:cartwheel_tone3:,:person_doing_cartwheel_tone3:

:cartwheel_tone4:,:person_doing_cartwheel_tone4:

:cartwheel_tone5:,:person_doing_cartwheel_tone5:
```

#### 1.1 / 2016-07-19

* additions
  * all of unicode 9
  * :gay_pride_flag:

* important note
  * because aliases are pipe-delimited strings, we have removed square bracket encapsulation and replaced with double-quote encapsulation

#### 0.9 / 2016-04-05

* additions
  * :paw_prints: alias to paw prints
  * :thumbup: alias to thumbs up sign
  * :thumbup_tone1: alias to thumbs up sign tone 1
  * :thumbup_tone2: alias to thumbs up sign tone 2
  * :thumbup_tone3: alias to thumbs up sign tone 3
  * :thumbup_tone4: alias to thumbs up sign tone 4
  * :thumbup_tone5: alias to thumbs up sign tone 5
  * :thumbdown: alias to thumbs down sign
  * :thumbdown_tone1: alias to thumbs down sign tone 1
  * :thumbdown_tone2: alias to thumbs down sign tone 2
  * :thumbdown_tone3: alias to thumbs down sign tone 3
  * :thumbdown_tone4: alias to thumbs down sign tone 4
  * :thumbdown_tone5: alias to thumbs down sign tone 5

#### 0.8 / 2015-12-17

  * Initial commit
