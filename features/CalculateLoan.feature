@calculate-loan
Feature: Calculate loan
  @calculate-loan-integers
  Scenario: Calculation happy path integers
    Given calculate loan amount "2750" in term "24" and assign result to "fee" with data
    And the "fee" is equal "115"
    Given calculate loan amount "11500" in term "24" and assign result to "fee" with data
    And the "fee" is equal "460"
    Given calculate loan amount "19250" in term "12" and assign result to "fee" with data
    And the "fee" is equal "385"
    Given calculate loan amount "1" in term "12" and assign result to "fee" with data
    And the "fee" is equal "4"
  @calculate-loan-max
  Scenario: Calculation happy path max
    Given calculate loan amount "20000" in term "24" and assign result to "fee" with data
    And the "fee" is equal "800"
  @calculate-loan-float
  Scenario: Calculation happy path float
    Given calculate loan amount "1.33" in term "12" and assign result to "fee" with data
    And the "fee" is equal "3.67"
    Given calculate loan amount "19999.99" in term "24" and assign result to "fee" with data
    And the "fee" is equal "800.01"
  @calculate-loan-limits
  Scenario: Calculation happy path float
    Given calculate loan amount "20001" in term "12" and assign result to "fee" with data
    And the "fee" is equal "to high amount"
    Given calculate loan amount "0.1" in term "24" and assign result to "fee" with data
    And the "fee" is equal "to low amount"
    Given calculate loan amount "3" in term "13" and assign result to "fee" with data
    And the "fee" is equal "empty structure"