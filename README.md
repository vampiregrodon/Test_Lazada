MODULE : Restful

1. Get List Post :
	GET http://localhost/zf2/public/json-restful-post

2. Create a Post :
	POST http://localhost/zf2/public/json-restful-post	
	params : {'title'=>'input Title', 'content'=>'input Content'}

3. Get List Tags :
	GET http://localhost/zf2/public/json-restful-tags

4. Create a Tag :
	POST http://localhost/zf2/public/json-restful-tags	
	params : {'post_id'=>'1', 'name'=>'input Name Tags'}	

5. Select all posts by tag or tags :
	POST http://localhost/zf2/public/post/get-list-by-tag
	params : {'tag'=>'input Tag name',...}

6. Count posts by tag or tags :
	POST http://localhost/zf2/public/post/count-list-by-tag	
	params : {'tag'=>'input Tag name',....}


   