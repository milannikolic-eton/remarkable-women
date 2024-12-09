<?php 
$facebook = get_field('facebook_url', 'option');
$twitter = get_field('twitter_url', 'option');
$instagram = get_field('instagram_url', 'option');
$linkedln = get_field('linkedln_url', 'option');
$youtube = get_field('youtube_url', 'option');
?>
<div class="socials flex flex-vertical-center flex-center">


<?php if($youtube){ ?>
    <a href="<?php echo $youtube; ?>" target="_blank" class="yt">
<svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="0 0 30 23" fill="none">
  <g clip-path="url(#clip0_63_1540)">
    <path d="M28.8769 18.7666C28.7323 19.5188 28.3564 20.2071 27.8018 20.7355C27.2471 21.2638 26.5413 21.6057 25.7829 21.7136C22.1239 22.2497 18.431 22.5204 14.7329 22.5236C11.0351 22.5142 7.34258 22.2435 3.68292 21.7136C2.92454 21.6057 2.21875 21.2638 1.66408 20.7355C1.10941 20.2071 0.733537 19.5188 0.588923 18.7666C0.186302 16.3567 -0.0107408 13.9169 -7.76785e-05 11.4736C-0.0107408 9.03029 0.186302 6.5905 0.588923 4.18058C0.733537 3.42834 1.10941 2.74003 1.66408 2.21171C2.21875 1.68339 2.92454 1.34144 3.68292 1.23358C7.3419 0.697445 11.0349 0.426738 14.7329 0.423584C18.4309 0.42986 22.1236 0.70055 25.7829 1.23358C26.5413 1.34144 27.2471 1.68339 27.8018 2.21171C28.3564 2.74003 28.7323 3.42834 28.8769 4.18058C29.3109 6.5875 29.5328 9.02787 29.5399 11.4736C29.4954 13.9174 29.2738 16.3548 28.8769 18.7666Z" fill="#fff"/>
    <path d="M11.7871 16.6297V6.31665L20.6271 11.4736L11.7871 16.6297Z" fill="transparent"/>
  </g>
  <defs>
    <clipPath id="clip0_63_1540">
      <rect width="29.54" height="22.1" fill="white" transform="translate(0 0.423584)"/>
    </clipPath>
  </defs>
</svg>
    </a>
<?php } ?>

<?php if ($facebook): ?>
    <a href="<?php echo $facebook; ?>" target="_blank" class="fb">
<svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" viewBox="0 0 26 25" fill="none">
  <g clip-path="url(#clip0_63_1543)">
    <path d="M13.013 4.00903e-08C10.5461 0.000197818 8.13471 0.731895 6.08367 2.10257C4.03262 3.47324 2.43408 5.42132 1.49019 7.70048C0.546287 9.97964 0.299422 12.4875 0.780808 14.907C1.26219 17.3264 2.45021 19.5488 4.19463 21.2931C5.93905 23.0374 8.16153 24.2252 10.581 24.7064C13.0005 25.1876 15.5084 24.9405 17.7875 23.9965C20.0665 23.0524 22.0145 21.4537 23.385 19.4025C24.7555 17.3514 25.487 14.9399 25.487 12.473C25.487 10.8349 25.1644 9.21292 24.5375 7.69956C23.9106 6.1862 22.9917 4.81114 21.8334 3.6529C20.6751 2.49467 19.2999 1.57593 17.7865 0.949163C16.2731 0.322395 14.6511 -0.000131289 13.013 4.00903e-08Z" fill="#fff"/>
    <path d="M14.704 15.7789H17.932L18.439 12.4999H14.704V10.7079C14.704 9.3459 15.149 8.1379 16.423 8.1379H18.471V5.2759C17.6233 5.16141 16.7684 5.1096 15.913 5.1209C12.913 5.1209 11.151 6.7059 11.151 10.3209V12.4999H8.06104V15.7789H11.147V24.7919C12.3238 24.9888 13.5243 24.9982 14.704 24.8199V15.7789Z" fill="transparent"/>
  </g>
  <defs>
    <clipPath id="clip0_63_1543">
      <rect width="24.947" height="24.947" fill="white" transform="translate(0.540039)"/>
    </clipPath>
  </defs>
</svg>
    </a>
<?php endif; ?>




<?php if($linkedln){ ?>
    <a href="<?php echo $linkedln; ?>" target="_blank"  class="ln">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <g clip-path="url(#clip0_63_1546)">
    <path d="M19.1588 0.98291H4.79582C3.65308 0.983175 2.55722 1.43724 1.74919 2.24528C0.941149 3.05332 0.487082 4.14917 0.486816 5.29191L0.486816 19.6549C0.487082 20.7976 0.941149 21.8935 1.74919 22.7015C2.55722 23.5096 3.65308 23.9636 4.79582 23.9639H19.1588C20.3016 23.9636 21.3974 23.5096 22.2054 22.7015C23.0135 21.8935 23.4676 20.7976 23.4678 19.6549V5.29191C23.4676 4.14917 23.0135 3.05332 22.2054 2.24528C21.3974 1.43724 20.3016 0.983175 19.1588 0.98291ZM7.59282 20.4899H4.02182L4.00182 9.80091H7.57182L7.59282 20.4899ZM5.71782 8.40291H5.69682C5.44855 8.41803 5.19983 8.3818 4.9662 8.29647C4.73257 8.21114 4.51905 8.07855 4.33897 7.90697C4.15889 7.7354 4.01613 7.52854 3.9196 7.29931C3.82308 7.07008 3.77486 6.8234 3.77796 6.5747C3.78106 6.32599 3.83542 6.0806 3.93763 5.85384C4.03985 5.62709 4.18772 5.42385 4.37202 5.25683C4.55632 5.0898 4.77309 4.96257 5.00878 4.8831C5.24446 4.80362 5.49401 4.7736 5.74182 4.79491C5.99118 4.77629 6.2417 4.80955 6.47758 4.89258C6.71345 4.97561 6.92956 5.10662 7.11228 5.27734C7.295 5.44805 7.44036 5.65478 7.5392 5.88448C7.63803 6.11418 7.6882 6.36187 7.68654 6.61193C7.68488 6.86198 7.63142 7.10898 7.52953 7.33735C7.42765 7.56571 7.27955 7.77049 7.09458 7.93876C6.9096 8.10703 6.69177 8.23515 6.45481 8.31504C6.21785 8.39492 5.96691 8.42484 5.71782 8.40291ZM19.9698 20.4899H16.3698V14.6829C16.3698 13.2779 15.9968 12.3209 14.7398 12.3209C14.3548 12.3233 13.9803 12.4476 13.6703 12.6759C13.3602 12.9043 13.1304 13.2249 13.0138 13.5919C12.9231 13.8643 12.8834 14.1511 12.8968 14.4379V20.4899H9.27682L9.25682 9.80091H12.8748L12.8958 11.3099C13.1968 10.7641 13.6443 10.3132 14.1877 10.0081C14.7312 9.70298 15.3491 9.55571 15.9718 9.58291C18.2578 9.58291 19.9668 11.0749 19.9668 14.2829V20.4909L19.9698 20.4899Z" fill="#0A3652"/>
  </g>
  <defs>
    <clipPath id="clip0_63_1546">
      <rect width="22.981" height="22.981" fill="white" transform="translate(0.486816 0.98291)"/>
    </clipPath>
  </defs>
</svg>
    </a>
<?php } ?>


<?php if($instagram){ ?>
    <a href="<?php echo $instagram; ?>" target="_blank" class="instagram">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <g clip-path="url(#clip0_63_1548)">
    <path d="M6.85177 0.98291C5.15863 0.98291 3.53484 1.65551 2.3376 2.85274C1.14037 4.04997 0.467773 5.67377 0.467773 7.36691V17.5829C0.467773 19.2761 1.14037 20.8998 2.3376 22.0971C3.53484 23.2943 5.15863 23.9669 6.85177 23.9669H17.0678C18.7604 23.9661 20.3834 23.2932 21.58 22.096C22.7766 20.8989 23.4488 19.2755 23.4488 17.5829V7.36691C23.4488 5.67429 22.7766 4.05095 21.58 2.8538C20.3834 1.65665 18.7604 0.983706 17.0678 0.98291H6.85177ZM19.6188 3.53591C19.8713 3.53591 20.1182 3.6108 20.3282 3.75112C20.5382 3.89144 20.7019 4.09088 20.7986 4.32422C20.8952 4.55756 20.9205 4.81433 20.8712 5.06204C20.822 5.30975 20.7003 5.53729 20.5217 5.71589C20.3432 5.89448 20.1156 6.0161 19.8679 6.06537C19.6202 6.11465 19.3634 6.08936 19.1301 5.9927C18.8967 5.89605 18.6973 5.73237 18.557 5.52237C18.4167 5.31237 18.3418 5.06548 18.3418 4.81291C18.3418 4.64521 18.3748 4.47916 18.439 4.32422C18.5032 4.16929 18.5972 4.02852 18.7158 3.90993C18.8344 3.79135 18.9752 3.69729 19.1301 3.63312C19.285 3.56894 19.4511 3.53591 19.6188 3.53591ZM11.9578 6.08991C13.2205 6.08971 14.4549 6.46398 15.5049 7.16539C16.5549 7.8668 17.3733 8.86383 17.8566 10.0304C18.3399 11.197 18.4665 12.4807 18.2202 13.7191C17.9739 14.9576 17.3658 16.0952 16.4729 16.9881C15.5801 17.881 14.4425 18.489 13.204 18.7353C11.9655 18.9816 10.6818 18.8551 9.51526 18.3718C8.3487 17.8885 7.35166 17.07 6.65026 16.02C5.94885 14.97 5.57458 13.7356 5.57477 12.4729C5.57504 10.7801 6.24762 9.15673 7.4446 7.95974C8.64159 6.76275 10.265 6.09018 11.9578 6.08991ZM11.9578 8.64291C11.2003 8.64291 10.4598 8.86754 9.82994 9.28838C9.2001 9.70923 8.7092 10.3074 8.41931 11.0072C8.12943 11.7071 8.05358 12.4772 8.20137 13.2201C8.34915 13.9631 8.71392 14.6455 9.24955 15.1811C9.78519 15.7168 10.4676 16.0815 11.2106 16.2293C11.9535 16.3771 12.7236 16.3013 13.4235 16.0114C14.1233 15.7215 14.7215 15.2306 15.1423 14.6007C15.5631 13.9709 15.7878 13.2304 15.7878 12.4729C15.7878 11.9699 15.6887 11.4719 15.4962 11.0072C15.3038 10.5426 15.0216 10.1203 14.666 9.76469C14.3103 9.40904 13.8881 9.12693 13.4235 8.93445C12.9588 8.74198 12.4607 8.64291 11.9578 8.64291Z" fill="#0A3652"/>
  </g>
  <defs>
    <clipPath id="clip0_63_1548">
      <rect width="22.981" height="22.981" fill="white" transform="translate(0.467773 0.98291)"/>
    </clipPath>
  </defs>
</svg>
    </a>
<?php } ?>

</div>