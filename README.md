## Note: Backup database first

### Delete spam comments

```DELETE FROM wp_comments WHERE comment_approved = 'spam'```

### Clear out unused tags

```DELETE FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE count = 0 );```

```DELETE FROM wp_term_relationships WHERE term_taxonomy_id not IN (SELECT term_taxonomy_id FROM wp_term_taxonomy);```

### Clear posst meta not use

```
DELETE pm
FROM wp_postmeta pm
LEFT JOIN wp_posts wp ON wp.ID = pm.post_id
WHERE wp.ID IS NULL
```

### Clear order items not use

```
DELETE ois
FROM wp_woocommerce_order_items ois
LEFT JOIN wp_posts wp ON wp.ID = ois.order_id
WHERE wp.ID IS NULL
```

### Delete Post Revisions

```
DELETE a,b,c
 FROM wp_posts a
 LEFT JOIN wp_term_relationships b ON ( a.ID = b.object_id)
 LEFT JOIN wp_postmeta c ON ( a.ID = c.post_id )
 LEFT JOIN wp_term_taxonomy d ON ( b.term_taxonomy_id = d.term_taxonomy_id)
 WHERE a.post_type = 'revision'
 AND d.taxonomy != 'link_category';
```
 
### Remove Pingbacks and Trackbacks

```DELETE FROM wp_comments WHERE comment_type = 'pingback';```

```DELETE FROM wp_comments WHERE comment_type = 'trackback';```

### Delete any orphaned commentmeta

```DELETE FROM wp_commentmeta WHERE comment_id NOT IN (SELECT comment_id FROM wp_comments);```

### Remove wp_session data

```DELETE FROM `wp_options` WHERE `option_name` LIKE '_wp_session_%'```

### Delete expired transients:

```DELETE FROM `wp_options` WHERE `option_name` LIKE ('%_transient_%')```

### Delete Feed Cache

```DELETE FROM `wp_options` WHERE `option_name` LIKE ('_transient%_feed_%')```

### Batch Delete Old Posts

```
DELETE FROM `wp_posts`
WHERE `post_type` = 'post'
AND DATEDIFF(NOW(), `post_date`) > 600
```

### Remove Comment Agent

```UPDATE wp_comments set comment_agent ='' ;```
