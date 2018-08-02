<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'products' => [
            'stock_is_not_enough' => 'Stock is not enough.',
        ],
        'users' => [
            'balance_is_not_enough' => 'Balance is not enough.',
            'game_token_is_not_enough' => 'Game Token is not enough.',
            'user_is_not_yet_verified' => 'User is not yet verified.',
            'verification_code_is_invalid' => ':attribute is invalid.',
        ],
        'users_games' => [
            'id_has_been_used' => ':attribute has been used.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'access_token' => 'Access Token',
        'address' => 'Address',
        'address_as' => 'Address as',
        'amount' => 'Amount',
        'author' => 'Author',
        'balance' => 'Balance',
        'balance_end' => 'End Balance',
        'balance_start' => 'Start Balance',
        'client_id' => 'Client Id',
        'code' => 'Code',
        'content' => 'Content',
        'count' => 'Count',
        'created_at' => 'Created At',
        'data' => 'Data',
        'date_of_birth' => 'Date of Birth',
        'description' => 'Description',
        'district_id' => 'District',
        'email' => 'Email',
        'excerpt' => 'Excerpt',
        'finished' => 'Finished',
        'game_token' => 'Game Token',
        'game_token_end' => 'End Game Token',
        'game_token_start' => 'Start Game Token',
        'gender' => 'Gender',
        'grand_total' => 'Grand Total',
        'guard_name' => 'Guard Name',
        'id' => 'Id',
        'latitude' => 'Latitude',
        'locale' => 'Locale',
        'longitude' => 'Longitude',
        'mime_type' => 'Mime Type',
        'name' => 'Name',
        'notes' => 'Notes',
        'number' => 'Number',
        'parent' => 'Parent',
        'parent_id' => 'Parent Id',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'payment_date' => 'Payment Date',
        'payment_status' => 'Payment Status',
        'phone_number' => 'Phone Number',
        'post_id' => 'Post',
        'postal_code' => 'Postal Code',
        'price' => 'Price',
        'primary' => 'Primary',
        'product_id' => 'Product Id',
        'product_status' => 'Always Available',
        'provider' => 'Provider',
        'province_id' => 'Province',
        'quantity' => 'Quantity',
        'rajaongkir_id' => 'Rajaongkir Id',
        'rating' => 'Rating',
        'receipt_number' => 'Receipt Number',
        'reference_id' => 'Reference Id',
        'regency_id' => 'Regency',
        'sell_price' => 'Sell Price',
        'slug' => 'Slug',
        'special_sell_price' => 'Special Sell Price',
        'status' => 'Status',
        'stock' => 'Stock',
        'store_id' => 'Store Id',
        'taxonomy' => 'Taxonomy',
        'template' => 'Template',
        'title' => 'Title',
        'token' => 'Token',
        'transaction_id' => 'Transaction Id',
        'type' => 'Type',
        'updated_at' => 'Updated At',
        'url' => 'Url',
        'user' => 'User',
        'user_id' => 'User Id',
        'username' => 'Username',
        'value' => 'Value',
        'verification_code' => 'Verification Code',
        'verified' => 'Verified',
        'weight' => 'Weight',
    ],

];
